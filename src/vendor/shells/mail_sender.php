<?php 

App::import('Lib', 'function_core');

class MailSenderShell extends Shell {
/**
 * List of tasks for this shell
 *
 * @var array
 */
    public $tasks = array('Email');

/**
 * Main Model
 *
 * @var array
 */
    public $uses = array('Lmail');
    
/**
 * how many mails should delivery in each batch
 *
 * @var integer
 */
	public $npb = 3;

/**
 * Email task
 *
 * @var EmailTask
 */
    public $Email;

/**
 * Startup method for the shell
 *
 * Lets set some default params for the EmailTask
 *
 */
    function startup() {
	    $this->out("Start up");
    }

/**
 * Send just one email
 *
 */
    public function sendHello() {
        $this->Email->settings(array(
            'from' => '乐够乐透 <no-reply@logoloto.com>',
            'to' => 'support@logoloto.com',
			'subject' => '乐够乐透系统邮件',
        	'template' => '__system__send_hello_mail__message',
            'sendAs' => 'both',
            'delivery' => 'smtp'
        ));
    	
        return $this->Email->send(array(
            'to' => 'peregrinator@msn.cn',
        	'bcc' => array('263206207@qq.com'),
            'subject' => "Hello, i'Vincent"
        ));
    }

/**
 * Send multiple emails, change a few variables on the fly
 * and test that we can 'set' variables to the view
 *
 */
    public function dequeueLmails($priority = 100) {
    	$t = date('Y-m-d H:i:s');
	    $this->out("[$t] Dequeue mails ...");

        $this->Email->settings(array(
        	'template' => '__empty_template__message',
            'sendAs' => 'html',
            'delivery' => 'smtp'
        ));

    	$lmails = $this->Lmail->find('all', array(
    		'conditions' => array('status' => 'CONFIRMED', 'id >=' => 1150),
    		// 'order' => 'id desc',
    		'limit' => $this->npb
    	));

    	$failedMailIds = array();

		// Update mails status
    	if (!empty($lmails)) {
	    	$lmailIds = "";
    		$i = 0;
	        foreach ($lmails AS $lmail) {
	        	if ($i++ != 0) {
	        		$lmailIds .= ',';
	        	}

	        	$lmailIds .= $lmail['Lmail']['id'];
	        }

	        $sql = "UPDATE `lmails` SET `status`='SENDING' WHERE `id` IN ($lmailIds)";
	        $this->out("Update lmail status as SENDING ...");
	        $this->out($sql);
        	$this->Lmail->query($sql);
        }

       	$this->out("mails to send: ".count($lmails));
       	$i = 0;
        foreach ($lmails AS $lmail) {
        	++$i;

        	$this->out("$i mail to : {$lmail['Lmail']['to']}");
        	$this->Email->set('content_html', $lmail['Lmail']['content_html']);

        	$ret = $this->Email->send(array(
                'from' => $lmail['Lmail']['from'], 
            	'to' => $lmail['Lmail']['to'], 
				'subject' => $lmail['Lmail']['subject']
            ));

        	if (!$ret) {
        		$failedMailIds[] = $lmail['Lmail']['id'];
	    	}
        }

        if (!empty($failedMailIds)) {
        	$failedMailIdsStr = implode(',', $failedMailIds);
	        $sql = "UPDATE `lmails` SET `status`='FAILED' WHERE `id` IN ($failedMailIdsStr)";
	        $this->out("Update lmail status as FAILED ...");
	        $this->out($sql);
        	$this->Lmail->query($sql);
        }

        if (!empty($lmails)) {
        	$lmailIds = "";
	        $i = 0;
	        foreach ($lmails AS $lmail) {
	        	if (!in_array($lmail['Lmail']['id'], $failedMailIds)) {
		        	if ($i++ != 0) {
		        		$lmailIds .= ',';
		        	}

		        	$lmailIds .= $lmail['Lmail']['id'];
	        	}
	        }

	        $sql = "UPDATE `lmails` SET `status`='SENT' WHERE `id` IN ($lmailIds)";
	        $this->out("Update lmail status as SENT ...");
	        $this->out($sql);
        	$this->Lmail->query($sql);
        }

        $t = date('Y-m-d H:i:s');
	    $this->out("[$t] Finished . Wait for next trial ...");
    }
}
?>
