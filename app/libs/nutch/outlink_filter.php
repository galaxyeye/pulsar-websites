<?php 
class OutlinkFilter {

  private $data = array(
      'pageType' => 'NONE',
      'urlFilter' => null,
      'textFilter' => null,
      'parseBlockFilter' => null
  );

  public function __construct($pageType, $urlFilter, $textFilter = null, $parseBlockFilter = null) {
    $this->data['pageType'] = $pageType;
    $this->data['urlFilter'] = $urlFilter;

    if (is_string($textFilter)) {
    	$this->data['textFilter'] = json_decode($textFilter, true, 4);
    }
    else if (is_array($textFilter)) {
    	$this->data['parseBlockFilter'] = $textFilter;
    }

    if (is_string($parseBlockFilter)) {
	    $this->data['parseBlockFilter'] = json_decode($parseBlockFilter, true, 4);
    }
    else if (is_array($parseBlockFilter)) {
    	$this->data['parseBlockFilter'] = $parseBlockFilter;
    }
  }

  public function getPageType() {
    return $this->data['pageType'];
  }

  public function setPageType($pageType) {
    $this->data['pageType'] = $pageType;
  }

  public function getUrlFilter() {
  	return $this->data['urlFilter'];
  }

  public function setUrlFilter($urlFilter) {
  	$this->data['urlFilter'] = $urlFilter;
  }

  public function getTextFilter() {
  	return $this->data['textFilter'];
  }

  public function setTextFilter($textFilter) {
  	$this->data['textFilter'] = $textFilter;
  }

  public function getParseBlockFilter() {
  	return $this->data['parseBlockFilter'];
  }

  public function setParseBlockFilter($parseBlockFilter) {
  	$this->data['parseBlockFilter'] = $parseBlockFilter;
  }

  public function data() {
  	return $this->data;
  }

  public function __toString() {
  	if (empty($this->data['args'])) {
  		$this->data['args'] = new stdClass();
  	}

  	// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  	return json_encode($this->data);
  }
}
