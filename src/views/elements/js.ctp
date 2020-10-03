<?php

if (isset($html)) {
    echo $html->script("../vendor/jquery/jquery.min.js") . PHP_EOL;
    echo $html->script("../vendor/bootstrap/js/bootstrap.bundle.min.js") . PHP_EOL;
    echo $html->script("../vendor/jquery.easing/jquery.easing.min.js") . PHP_EOL;
    echo $html->script("../vendor/php-email-form/validate.js") . PHP_EOL;
    echo $html->script("../vendor/waypoints/jquery.waypoints.min.js") . PHP_EOL;
    echo $html->script("../vendor/counterup/counterup.min.js") . PHP_EOL;
    echo $html->script("../vendor/owl.carousel/owl.carousel.min.js") . PHP_EOL;
    echo $html->script("../vendor/isotope-layout/isotope.pkgd.min.js") . PHP_EOL;
    echo $html->script("../vendor/venobox/venobox.min.js") . PHP_EOL;
    echo $html->script("../vendor/aos/aos.js") . PHP_EOL;
    echo $html->script("../vendor/highlightjs/highlight.pack.js") . PHP_EOL;

    echo $html->script("../js/main.js") . PHP_EOL;
}

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
