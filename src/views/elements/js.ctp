<?php 
	// common javascript
	echo $html->script(JQUERY);
	echo $html->script(JQUERY_UI);
	echo $html->script(JSRENDER);
	echo $html->script(COMMON);
	echo $html->script(LAYER);
	echo $html->script(DUMP);

  if(!(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')) {
  }

	$base_dir = APP_SRC.WEBROOT_DIR.DS."js".DS.$this->params["controller"];
	// controller specified javascript
	if (is_file($base_dir.DS.$this->params["controller"].".js")) {
       	echo $html->script($this->params["controller"]."/".$this->params["controller"]);
	}
	// action specified javascript
	if (is_file($base_dir.DS.$this->params["action"].".js")) {
       	echo $html->script($this->params["controller"]."/".$this->params["action"]);
	}

	if (isset($scripts_for_layout)) {
		echo $scripts_for_layout;
	}

	echo $js->writeBuffer();
