<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<body id="<?php echo Inflector::variable($this->params['controller']) . Inflector::classify($this->params['action']) ?>">

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
            <h1 class="text-light"><a href="index.html"><span>柏拉图智能</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="#header">首页</a></li>
                <li><a href="#about">产品介绍</a></li>
                <li class="drop-down"><a href="#solutions">解决方案</a>
                    <ul>
                        <li><a href="#price-intelligent">价格情报</a></li>
                        <li><a href="#ecommerce">电商选品</a></li>
                        <li><a href="#marketing-channel">渠道巡检</a></li>
                        <li><a href="#product-building">构建产品</a></li>
                        <li><a href="#market-research">市场调查</a></li>
                        <li><a href="#customer-discovery">潜在顾客生成</a></li>
                        <li><a href="#brand-monitoring">品牌监测</a></li>
                        <li><a href="#financial">金融替代数据</a></li>
                        <li><a href="#solutions">查看全部</a></li>
                    </ul>
                </li>
                <li><a href="#more-services">案例演示</a></li>
                <li><a href="#pricing">价格方案</a></li>
                <li><a href="#team">团队</a></li>
                <li><a href="#contact">联系我们</a></li>

                <li class="get-started"><a href="#about">开始</a></li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->

<?php if (!empty($content_for_layout)) {
    echo $content_for_layout;
} ?>

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 text-lg-left text-center">
                <div class="copyright">
                    &copy; 版权所有 <strong>翘曲速率</strong>。保留所有权利。
                </div>
                <div class="credits">
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    ©2020 武汉翘曲速率信息科技有限公司 (鄂)-经营性-2018-2020
                    <a href="http://www.beian.miit.gov.cn">鄂ICP备19025511号</a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    <a href="#header" class="scrollto">首页</a>
                    <a href="#about" class="scrollto">关于</a>
                </nav>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- JavaScript -->
<?php
if (isset($js))
    if (isset($scripts_for_layout)) {
        echo $this->element('js', array (
            'scripts_for_layout' => $scripts_for_layout
        ) );
    }
?>

</body>
</html>
