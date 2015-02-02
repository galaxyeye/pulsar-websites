<?php 
	echo $html->css($css);

	// model specified css
	if (is_file(APP.WEBROOT_DIR.DS."css".DS.$this->params["controller"].DS.$this->params["controller"].".css")){ 
       echo $html->css($this->params["controller"]."/".$this->params["controller"]); 
	}
	// action specified css
	if (is_file(APP.WEBROOT_DIR.DS."css".DS.$this->params["controller"].DS.$this->params["action"].".css")){ 
       echo $html->css($this->params["controller"]."/".$this->params["action"]); 
	}
	// static pages
	if ('pages' === $this->params["controller"] && isset($this->viewVars['page'])
		&& is_file(APP.WEBROOT_DIR.DS."css".DS.$this->params["controller"].DS.$this->viewVars['page'].".css")){
       echo $html->css('pages/'.$this->viewVars['page']);
	}

	// other css
	if (isset($css_for_layout)){
		echo $css_for_layout;
	}

?>
