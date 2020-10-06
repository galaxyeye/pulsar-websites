<?php assert(isset($html)) ?>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
            <h1 class="text-light"><?php echo $html->link('柏拉图智能', "/"); ?></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active">
                    <?php echo $html->link('首页', '/#hero') ?>
                </li>
                <li><?php echo $html->link('产品介绍', '/#about') ?></li>
                <li class="drop-down"><a href="#">解决方案</a>
                    <ul>
                        <?php $solutions = array(
                            "solutions" => "查看全部",
                            "price-intelligent" => "价格情报",
                            "ecommerce" => "电商选品",
                            "marketing-channel" => "渠道巡检",
                            "product-building" => "构建产品",
                            "customer-research" => "市场调查",
                            "customer-discovery" => "潜在顾客生成",
                            "brand-monitoring" => "品牌监测",

                            "financial" => "金融替代数据"
                        )
                        ?>
                        <?php foreach ($solutions as $key => $value): ?>
                            <li><?php echo $html->link($value, '/#' . $key) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><?php echo $html->link('案例演示', '/#more-services') ?></li>
                <li><?php echo $html->link('价格方案', '/#pricing') ?></li>
                <li><?php echo $html->link('加入我们', '/jobs') ?></li>
                <li><?php echo $html->link('联系我们', '/#contact') ?></li>

                <li class="get-started"><a href="#about">开始</a></li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->
