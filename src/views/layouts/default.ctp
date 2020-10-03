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
    echo $this->element('js', array ('scripts_for_layout' => $scripts_for_layout));
} ?>

</body>
</html>
