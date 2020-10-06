<?php
assert(isset($html));

if (isset($scripts_for_layout)) {
    echo "<!-- page specified external scripts -->" . PHP_EOL;
    echo $scripts_for_layout;
    echo PHP_EOL;
}

if (!(isset($this->params['prefix']) && $this->params['prefix'] == 'admin')) {
}

$base_dir = WEBROOT_DIR . "js" . DS . $this->params["controller"];

if (is_file($base_dir . DS . $this->params["controller"] . ".js")) {
    echo "<!-- controller specified javascript -->" . PHP_EOL;
    echo $html->script($this->params["controller"] . "/" . $this->params["controller"]);
    echo PHP_EOL;
}

if (is_file($base_dir . DS . $this->params["action"] . ".js")) {
    echo "<!-- action specified javascript -->" . PHP_EOL;
    echo $html->script($this->params["controller"] . "/" . $this->params["action"]);
    echo PHP_EOL;
}

if (isset($js)) {
    echo $js->writeBuffer();
}
