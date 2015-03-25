<?php 

class HttpClient {

	private $options = array (
				CURLOPT_RETURNTRANSFER => true, // return web page
				CURLOPT_HEADER => false, // return headers
				CURLOPT_FOLLOWLOCATION => true, // follow redirects
				CURLOPT_ENCODING => "", // handle compressed
				CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:36.0) Gecko/20100101 Firefox/36.0", // who am i
				CURLOPT_AUTOREFERER => true, // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 30, // timeout on connect
				CURLOPT_TIMEOUT => 60, // timeout on response
				CURLOPT_MAXREDIRS => 3,

				CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
				CURLOPT_DNS_USE_GLOBAL_CACHE => false,
				CURLOPT_DNS_CACHE_TIMEOUT => 2
	); // stop after 3 redirects

	function __construct($options = null) {
		if ($options != null) {
			array_merge($this->options, $options);
		}
	}

	function url_exists($url) {
		if($url == NULL) return false;

		$options = $this->options;
		$options[CURLOPT_TIMEOUT] = 15;
		$options[CURLOPT_CONNECTTIMEOUT] = 15;
		$options[CURLOPT_RETURNTRANSFER] = true;

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);

		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if($httpcode >= 200 && $httpcode < 300){
			return true;
		} else {
			return false;
		}
	}

	public function get_content($url) {
		$options = array(CURLOPT_HEADER => true);
		$result = $this->get($url, $options);
		return $result['content'];
	}

	public function get($url, $options = null) {
		if ($options != null) {
			array_merge($this->options, $options);
		}

		$options = $this->options;

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);

		$content = curl_exec($ch);

		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$header = curl_getinfo($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		$header['errno'] = $err;
		$header['errmsg'] = $errmsg;
		return array('header' => $header, 'content' => $content);
	}

	public function putJson($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data))
		);

		$output = curl_exec($ch);
		curl_close($ch);

	  $this->_debugMsg("HttpClient::putJson ".$data);

		return $output;
	}

	public function put($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: text/html',
		'Content-Length: ' . strlen($data))
		);
	
		$output = curl_exec($ch);
		curl_close($ch);
	
		$this->_debugMsg("HttpClient::put ".$data);

		return $output;
	}

	public function postJson($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data))
		);

		$output = curl_exec($ch);
		curl_close($ch);

	  $this->_debugMsg("HttpClient::postJson ".$data);

		return $output;
	}

	private function _debugMsg($message) {
		// CakeLog::write('debug', $message);
	}
}
