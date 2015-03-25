<?php 
namespace Nutch;

class OutlinkFilter {

  private $data = array(
      'pageType' => 'NONE',
      'urlFilter' => null,
      'textFilter' => null,
      'blockFilter' => null
  );

  public function __construct($pageType, $urlFilter, $textFilter = null, $blockFilter = null) {
    $this->data['pageType'] = $pageType;
    $this->data['urlFilter'] = $urlFilter;

    if (is_string($textFilter)) {
    	$this->data['textFilter'] = json_decode($textFilter, true, 4);
    }
    else if (is_array($textFilter)) {
    	$this->data['blockFilter'] = $textFilter;
    }

    if (is_string($blockFilter)) {
	    $this->data['blockFilter'] = json_decode($blockFilter, true, 4);
    }
    else if (is_array($blockFilter)) {
    	$this->data['blockFilter'] = $blockFilter;
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

  public function getBlockFilter() {
  	return $this->data['blockFilter'];
  }

  public function setBlockFilter($blockFilter) {
  	$this->data['blockFilter'] = $blockFilter;
  }

  public function data() {
  	return $this->data;
  }

	public function __toString() {
		$data = $this->data;
	
		if (empty($data['args'])) {
			$data['args'] = new \stdClass();
		}
	
		// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		return json_encode($data);
	}
}
