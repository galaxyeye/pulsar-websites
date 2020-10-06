<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>柏拉图智能 - Web 数据革命</title>
    <meta content="" name="description">
    <meta content="数据采集，Web scraping，网络爬虫，电商大数据，数据资产管理" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <?php echo $this->element('css', array('css' =>
        array('../vendor/bootstrap/css/bootstrap.min',
            '../vendor/icofont/icofont.min',
            '../vendor/remixicon/remixicon',
            '../vendor/boxicons/css/boxicons.min',
            '../vendor/owl.carousel/assets/owl.carousel.min',
            '../vendor/venobox/venobox',
            '../vendor/highlightjs/styles/default',
            '../vendor/aos/aos',
            'style',
        )));
    ?>
</head>

<body
        id="<?php echo Inflector::variable($this->params['controller']) . Inflector::classify($this->params['action']) ?>"
        class="<?php if (isset($fullscreen)) echo "vh-100"; else echo "" ?>"
>

<?php echo $this->element('header') ?>

<?php if (!empty($content_for_layout)) {
    echo $content_for_layout;
} ?>

<?php
    if (!isset($fullscreen)) {
        echo $this->element('footer');
    }
?>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- JavaScript -->
<?php if (isset($scripts_for_layout)) {
    assert(isset($html));
    echo $html->script("../vendor/jquery/jquery.min.js") . PHP_EOL;
    echo $html->script("../vendor/bootstrap/js/bootstrap.bundle.min.js") . PHP_EOL;
    echo $html->script("../vendor/jquery.easing/jquery.easing.min.js") . PHP_EOL;
    echo $html->script("../vendor/php-email-form/validate.js") . PHP_EOL;
    echo $html->script("../vendor/waypoints/jquery.waypoints.min.js") . PHP_EOL;
    echo $html->script("../vendor/counterup/counterup.min.js") . PHP_EOL;
    echo $html->script("../vendor/isotope-layout/isotope.pkgd.min.js") . PHP_EOL;
    echo $html->script("../vendor/venobox/venobox.min.js") . PHP_EOL;
    echo $html->script("../vendor/aos/aos.js") . PHP_EOL;
    echo $html->script("../vendor/owl.carousel/owl.carousel.min.js") . PHP_EOL;

    echo $html->script("../vendor/highlightjs/highlight.pack.js") . PHP_EOL;

    echo $html->script("main.js") . PHP_EOL;

    echo $this->element('js', array ('scripts_for_layout' => $scripts_for_layout));
} ?>

</body>
</html>
