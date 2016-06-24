<?php 
App::import('Core', array('Router','Controller'));
App::import('Component', 'Email');

class EmailTask extends Shell {
/**
* Controller class
*
* @var Controller
*/
    var $Controller;

/**
* EmailComponent
*
* @var EmailComponent
*/
    var $Email;

/**
* List of default variables for EmailComponent
*
* @var array
*/
    var $defaults = array(
        'to'        => null,
        'subject'   => null,
        'charset'   => 'UTF-8',
        'from'      => null,
        'sendAs'    => 'html',
        'template'  => null,
        'debug'     => false,
        'additionalParams'    => '',
        'layout'    => 'default'
    );

/**
* Startup for the EmailTask
*
*/
    function initialize() {
	    include CONFIGS . 'routes.php';

		$this->Controller =& new Controller();
        $this->Email =& new EmailComponent(null);
        $this->Email->initialize($this->Controller);

	    loadEmailSettings('default', $this->Email);
    }

/**
* Send an email useing the EmailComponent
*
* @param array $settings
* @return boolean
*/
    function send($settings = array()) {
        $this->settings($settings);
        $ret = $this->Email->send();

    	if ($this->Email->smtpError) {
			$this->out('Failed to send email\\n\\tDetailed information:['.$this->Email->smtpError.']', LOG_ALERT);
	    }

		return $ret;
    }

/**
* Used to set view vars to the Controller so
* that they will be available when the view render
* the template
*
* @param string $name
* @param mixed $data
*/
    function set($name, $data) {
        $this->Controller->set($name, $data);
    }

/**
* Change default variables
* Fancy if you want to send many emails and only want
* to change 'from' or few keys
*
* @param array $settings
*/
    function settings($settings = array()) {
        $this->Email->_set($this->defaults = array_filter(am($this->defaults, $settings)));
    }
}
?>
