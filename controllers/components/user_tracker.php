<?php 
class UserTrackerComponent extends Object {

    public $controller;

    // Persistent cookie means the cookie's expires time would be very very long, 10 years, e.g.
    // it's used for Unique User Tracking
    public $uniqueCookie = null;

	public $uniqueId = null;

	public $historyUsers = array();

	public $lastUser = null;

    public function startup( &$controller ) {
    	$this->controller = &$controller;
    	$this->uniqueCookie = $this->controller->uniqueCookie;
    	if (!is_null($this->uniqueCookie)) {
    		$this->__parseUUCookie();
    	}
	}

	// Generate a new unique cookie to track the unique user
	// Unique User Tracking Cookie Format:
	// 128_bit_uuid[history_user_id1-history_user_id2-...-history_user_idn]current_user_id
	public function generateUUCookie() {
		if ($this->lastUser != null && ($this->lastUser === $this->controller->currentUser['id'])) {
			// Note:anonymous is considerd
			return null;
		}

		$uniqueId = $this->uniqueId;
		$usersInfo = '';

		if (empty($this->historyUsers)) {
			// assume to be the first visit from this browser, but exceptions are possible
			// case 1: the first time to visit any page, persist cookie: null, historyUsers: empty, lastUser: null, currentUser: 0
			// case 2: all cookie in this domain are cleared, persist cookie: null, historyUsers: empty, lastUser: null, currentUser: 0
			// case 3: session cookie OK, persistent cookie cleared, persist cookie: null, historyUsers: empty, lastUser: null, currentUser: loginUser
			$uniqueId = uniqid();
			$usersInfo .= $this->controller->currentUser['id'];
		}
		else {
			if (!in_array($this->controller->currentUser['id'], $this->historyUsers)) {
				// login for the first time
				array_push($this->historyUsers, $this->controller->currentUser['id']);
			}

			$i = 0;
			foreach ($this->historyUsers as $user) {
				$usersInfo .= (($i == 0) ? '' : '-');
				$usersInfo .= $user;
				++$i;
			}
		}

		return $uniqueId.'['.$usersInfo.']'.$this->controller->currentUser['id'];
	}

	private function __parseUUCookie() {
		assert(!is_null($this->uniqueCookie));

		$uucookie = &$this->uniqueCookie;
		$pos = strpos($uucookie, '[');
		$pos2 = strpos($uucookie, ']', $pos);

		$this->uniqueId = substr($uucookie, 0, $pos);
		$this->historyUsers = $this->__parseHistoryUsers(substr($uucookie, $pos + 1, $pos2 - $pos - 1));
		$this->lastUser = substr($uucookie, $pos2 + 1);
	}

	private function __parseHistoryUsers($usersStr) {
		return explode('-', $usersStr);
	}
}
?>
