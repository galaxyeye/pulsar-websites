<?php 
	// common javascript
	echo $html->script(JQUERY);
	echo $html->script(JSRENDER);

    if(!(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')) {
      echo $html->script(COMMON);
    }

	$base_dir = APP.WEBROOT_DIR.DS."js".DS.$this->params["controller"];
	// controller specified javascript
	if (is_file($base_dir.DS.$this->params["controller"].".js")){ 
       	echo $html->script($this->params["controller"]."/".$this->params["controller"]);
	}
	// action specified javascript
	if (is_file($base_dir.DS.$this->params["action"].".js")){ 
       	echo $html->script($this->params["controller"]."/".$this->params["action"]);
	}

	if (isset($scripts_for_layout)) {
		echo $scripts_for_layout;
	}

	echo $js->writeBuffer();
?>
