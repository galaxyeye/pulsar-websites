<?php
if (isset($html)) {
    if (isset($css)) {
        echo $html->css($css);
    }
}

$base_dir = WEBROOT_DIR . "css" . DS . $this->params["controller"];

// model specified css
if (is_file($base_dir . DS . $this->params["controller"] . ".css")) {
    echo $html->css($this->params["controller"]."/".$this->params["controller"]);
}

// action specified css
if (is_file($base_dir . DS . $this->params["controller"].DS.$this->params["action"].".css")){
   echo $html->css($this->params["controller"]."/".$this->params["action"]);
}

// static pages
if ('pages' === $this->params["controller"] && isset($this->viewVars['page'])
    && is_file($base_dir . DS . $this->params["controller"].DS.$this->viewVars['page'].".css")){
   echo $html->css('pages/'.$this->viewVars['page']);
}

// other css
if (isset($css_for_layout)){
    echo $css_for_layout;
}
