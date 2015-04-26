<?php 
namespace Nutch;

class NCrawlFilter {

  private $data = array(
      'pageType' => 'NONE',
      'urlRegexRule' => null,
      'textFilter' => null,
      'blockFilter' => null
  );

  public function __construct($pageType, $urlRegexRule, $textFilter = null, $blockFilter = null) {
    $this->data['pageType'] = $pageType;
    $this->data['urlRegexRule'] = $urlRegexRule;

    if (is_string($textFilter)) {
    	$this->data['textFilter'] = json_decode($textFilter, true, 4);
    }
    else if (is_object($textFilter)) {
    	$this->data['textFilter'] = $textFilter;
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

  public function getUrlRegexRule() {
  	return $this->data['urlRegexRule'];
  }

  public function setUrlRegexRule($urlRegexRule) {
  	$this->data['urlRegexRule'] = $urlRegexRule;
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