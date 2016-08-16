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

  private $url = false;
  private $debugMsg = true;

  function __construct($options = null) {
    if ($options != null) {
      array_merge($this->options, $options);
    }
  }
  
  public function setDebugMsg($debugMsg) {
    $this->debugMsg = $debugMsg;
  }

  function url_exists($url) {
    if($url == NULL) return false;
    $this->url = $url;

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
  
  /**
   * @return string
   **/
  public function get_content($url) {
  	$this->url = $url;

    $options = array(CURLOPT_HEADER => true);
    $result = $this->get($url, $options);
    
    return $result['content'];
  }

  public function get($url, $options = null) {
  	$this->url = $url;

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

  /**
   * @param string $url
   * @param string $data
   * @return object
   **/
  public function putJson($url, $data) {
  	$this->url = $url;

    if (empty($data)) {
      CakeLog::write('error', "Empty data to put at line ".__LINE__);
      return;
    }

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

  /**
   * @param string $url
   * @param string $data
   * @return string
   **/
  public function put($url, $data) {
  	$this->url = $url;

    if (empty($data)) {
      CakeLog::write('error', "Empty data to put at line ".__LINE__);
      return;
    }

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

    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    $this->_debugMsg("HttpClient::put ".$data);

    $header['errno'] = $err;
    $header['errmsg'] = $errmsg;

    return ['header' => $header, 'content' => $output];
  }

  /**
   * @param string $url target url
   * @param string $data query data
   * @param bool $metadata Show metadata or not
   * @return object
   **/
  public function postJson($url, $data) {
  	$this->url = $url;

    if (empty($data)) {
      CakeLog::write('error', "Empty data to post at line ".__LINE__);
      return;
    }

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

    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    $this->_debugMsg("HttpClient::postJson ".$data);

    $header['errno'] = $err;
    $header['errmsg'] = $errmsg;
    $header['requestData'] = $data;

    return ['header' => $header, 'content' => $output];
  }

  private function _debugMsg($message) {
  	if ($this->debugMsg) {
      CakeLog::write('debug', $this->url . ' '. $message);
  	}
  }
}
