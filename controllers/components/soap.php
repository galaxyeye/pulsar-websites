<?php
class SoapComponent extends Component
{
	var $defaultClientOptions = array(
	   'endpoint' => '',
	   'wsdl' => false,
	   'proxyhost' => false,
	   'proxyport' => false,
	   'proxyusername' => false,
	   'proxypassword' => false,
	   'timeout' => 0,
	   'response_timeout' => 20,
	);

	var $defaultCallOptions = array(
	    'serviceUrl' => '',
	    'operation' => '',
	    'namespace' => 'http://tempuri.org',
	    'soapAction' => '',
	    'params' => array(),
	    'debug' => false, // set to true to return debug info
	    'encoding' => 'UTF-8',
	    'rpcParams' => null,
	    'style' => 'rpc',
	    'headers' => false,
	    'use' => 'encoded',
	    'autoCheckWSDL' => true, // if serviceUrl end with "?WSDL" then set the client options['wsdl'] to be true
	);

	function initialize(&$controller) {
		App::import('Vendor', 'nusoap/lib/nusoap');
	}

	/**
	 * @author RainChen @ Wed Mar 12 17:55:37 CST 2008
	 * @uses return a soap client object
	 * @access public
	 * @param mix $options (see $this->defaultClientOptions)
	 * @return object
	 * @version 0.1
	 */
	function client($options)
	{
		$defaultClientOptions = $this->defaultClientOptions;
		if(!is_array($options))
		{
			$options = array('endpoint' => $options);
		}
		$options = am($this->defaultClientOptions, $options);

		return (new nusoap_client(
		$options['endpoint']
		, $options['wsdl']
		, $options['proxyhost']
		, $options['proxyport']
		, $options['proxyusername']
		, $options['proxypassword']
		, $options['timeout']
		, $options['response_timeout']
		));
	}

	/**
	 * @author RainChen @ Wed Mar 12 17:55:16 CST 2008
	 * @uses quick call
	 * @access public
	 * @param array $options (see $this->defaultCallOptions)
	 * @return array
	 * @version 0.1
	 */
	function call($options)
	{
		$defaultOptions = $this->defaultCallOptions;
		$options = am($defaultOptions, $options);
		if($options['soapAction'] == '')
		{
			$options['soapAction'] = $options['namespace']. '/'. $options['operation'];
		}

		$clientOptions = $this->defaultClientOptions;
		$clientOptions['endpoint'] = $options['serviceUrl'];
		if($options['autoCheckWSDL'])
		{
			if(strpos($options['serviceUrl'], '?WSDL') > 0)
			{
				$clientOptions['wsdl'] = true;
			}
		}

		$client = $this->client($clientOptions);
		$client->soap_defencoding = $options['encoding'];
		$client->decode_utf8 = false;
		$result = $client->call($options['operation'], $options['params'], $options['namespace'], $options['soapAction'], $options['headers'], $options['rpcParams'], $options['style'], $options['use']);

		$return = array(
		    'fault' => null,
    		'error' => null,
    		'result' => null,
		);
		if($client->fault)
		{
			$return['fault'] = $result;
		}
		else
		{
			$err = $client->getError();
			if ($err)
			{
				$return['error'] = $err;
			}
			else
			{
				$return['result'] = $result;
			}
		}

		if($options['debug'])
		{
			$return['request'] = $client->request;
			$return['response'] = $client->response;
			$return['debug'] = $client->getDebug();
		}
		return $return;
	}

	/**
	 * @author RainChen @ Wed Mar 12 17:57:29 CST 2008
	 * @uses quick debug for $this->call() result;
	 * @access public
	 * @param array $result
	 * @return void
	 * @version 0.1
	 */
	function debug($result)
	{
		if ($result['fault']) {
			echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result['fault']); echo '</pre>';
		} else {
			if ($result['error']) {
				echo '<h2>Error</h2><pre>' . $result['error'] . '</pre>';
			} else {
				echo '<h2>Result</h2><pre>'; print_r($result['result']); echo '</pre>';
			}
		}
		echo '<h2>Request</h2><pre>' . htmlspecialchars($result['request'], ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2><pre>' . htmlspecialchars($result['response'], ENT_QUOTES) . '</pre>';
		echo '<h2>Debug</h2><pre>' . htmlspecialchars($result['debug'], ENT_QUOTES) . '</pre>';
	}

}
?>