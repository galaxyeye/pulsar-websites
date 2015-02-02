<?php
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * Logoloto(tm) :  The best CPA advertisement network (http://www.logoloto.com)
 * Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 *
 * @filesource
 * @copyright     Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)f
 */
?>
<?php
    class EMAIL_CONFIG {
    	public $smtpOptions = array(
            'port'=>'25',
            'timeout'=>'30',
            'host' => 'mail.logoloto.com',
            'username'=>'no-reply',
        	'password'=>'i*&2xbo(-qvx'
		);

        public $default = array(
            'from' => '乐够乐透网 <no-reply@logoloto.com>',
            'to' => 'support@logoloto.com',
			'subject' => '乐够乐透系统邮件',
        	'template' => '__system__send_hello_mail__message',
            'sendAs' => 'both',
            'delivery' => 'smtp',
        );

        public $test = array(
            'from' => '乐够乐透网 <no-reply@logoloto.com>',
            'to' => 'xiaosjw@163.com',
        	'bcc' => array(
        		'ivincent.zhang@gmail.com', 
        		'376462836@qq.com'
			),
			'subject' => '乐够乐透系统邮件',
        	'template' => '__system__send_hello_mail__message',
            'sendAs' => 'both',
            'delivery' => 'smtp',
        );
    }

    class EMAIL_AGENT {
    	public $entrance = array(
    		'logoloto.com'=>'mail.logoloto.com',
    		'126.com'=>'mail.126.com',
    		'139.com'=>'mail.139.com',
    		'163.com'=>'mail.163.com',
    		'188.com'=>'www.188.com',
    		'263.net'=>'mail.263.net',
    		'21cn.com'=>'mail.21cn.com',
    		'citiz.net'=>'mail.citiz.net',
    		'eyou.com'=>'mail.eyou.com',
    		'foxmail.com'=>'www.foxmail.com',
            'gmail.com'=>'www.gmail.com',
    		'hotmail.com'=>'mail.live.com',
            'msn.cn'=>'mail.live.com',
            'msn.com'=>'mail.live.com',
    		'people.com.cn'=>'mail.people.com.cn',
    		'qq.com'=>'mail.qq.com',
    		'sina.com'=>'mail.sina.com',
    		'sogou.com'=>'mail.sogou.com',
    		'sohu.com'=>'mail.sohu.com',
    		'tom.com'=>'mail.tom.com',
    		'yahoo.com'=>'mail.yahoo.com',
    		'yahoo.com.cn'=>'mail.yahoo.com.cn',
    		'yeah.net'=>'mail.yeah.net'
    	);
    }
?>
