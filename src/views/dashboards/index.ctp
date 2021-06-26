<?php assert(isset($html)) ?>
<?php assert(isset($solutions)) ?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">网络即数据库</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">让高价值网络数据触手可及</h2>
                <h3 data-aos="fade-up" data-aos-delay="400">
                使用 AI 和 SQL 将任意规模授权网站完整精确转变成数据。现在，您可以直接在 Web 上实施商业智能。</h3>
                <div data-aos="fade-up" data-aos-delay="800">
                  <a href="#about" class="btn-get-started scrollto">开始</a>
                  <?php echo $this->Html->link(__('亚马逊解决方案', true), '/pages/amazon', array('class' => 'btn-get-started')); ?>
                </div>
                <div data-aos="fade-up" data-aos-delay="1000" class='pt-5'>
				  <a href="http://platonic.fun/i/ai?url=aHR0cHM6Ly93d3cuYW1hem9uLmNvbS9CZXN0LVNlbGxlcnMtQXV0b21vdGl2ZS96Z2JzL2F1dG9tb3RpdmUvcmVmPXpnX2JzX25hdl8w"
                            class="demo" target="_blank">AI 自动挖掘</a>
                  <a href="http://platonic.fun/i/ai?mode=dev&url=aHR0cHM6Ly93d3cuYW1hem9uLmNvbS9CZXN0LVNlbGxlcnMtQXV0b21vdGl2ZS96Z2JzL2F1dG9tb3RpdmUvcmVmPXpnX2JzX25hdl8w"
                            class="demo" target="_blank">AI 辅助挖掘</a>
                    <a class="demo" href="http://bi.platonic.fun/collection/43" target="_blank">X-SQL 演示</a>
                    <a class="demo" href="https://github.com/platonai" target="_blank">开源版 Github</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                <!--                -->
              <?php //echo $html->img("img/hero-img.png", array("class" => "img-fluid animated")) ?>
                <img src="img/hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>
<!-- End Hero -->

<main id="main">

    <!-- ======= Clients Section ======= -->
    <!--    <section id="clients" class="clients clients">-->
    <!--      <div class="container">-->

    <!--        <div class="row">-->

    <!--          <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <img src="img/clients/client-1.png" class="img-fluid" alt="" data-aos="zoom-in">-->
    <!--          </div>-->

    <!--          <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <img src="img/clients/client-2.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">-->
    <!--          </div>-->

    <!--          <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <img src="img/clients/client-3.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="200">-->
    <!--          </div>-->

    <!--          <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <img src="img/clients/client-4.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="300">-->
    <!--          </div>-->

    <!--          <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <img src="img/clients/client-5.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="400">-->
    <!--          </div>-->

    <!--          <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <img src="img/clients/client-6.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="500">-->
    <!--          </div>-->

    <!--        </div>-->

    <!--      </div>-->
    <!--    </section>&lt;!&ndash; End Clients Section &ndash;&gt;-->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>产品介绍</h2>
            </div>

            <div class="row content">
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        <b>网络即数据库</b>
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> <b>X-SQL</b> - 架构在 Web 上的
                            SQL 引擎，Web 和本地数据库同等对待
                        </li>
                        <li><i class="ri-check-double-line"></i> <b>人工智能</b> -
                            人工智能驱动的自动网页挖掘技术，零干预或极少干预，超大规模网页<b>完整精确</b>还原为数据
                        </li>
                        <li><i class="ri-check-double-line"></i> <b>弹性计算</b> -
                            分布式网页渲染引擎满足任意规模的数据采集需求
                        </li>
                        <li><i class="ri-check-double-line"></i> <b>商业智能</b> - 在 Web
                            上应用商业智能，捕捉成千上万高价值事件，回答利益攸关的业务问题
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 pt-4 pt-lg-0" data-aos="fade-up"
                     data-aos-delay="300">
     <pre>
      <code class="language-sql">-- 将一组亚马逊产品页转变成本地表
select
    dom_base_uri(dom) as `url`,
    dom_first_text(dom, '#productTitle') as `title`,
    str_substring_after(dom_first_href(dom, '#wayfinding-breadcrumbs_container ul li:last-child a'), '&node=') as `category`,
    dom_first_slim_html(dom, '#bylineInfo') as `brand`,
    cast(dom_all_slim_htmls(dom, '#imageBlock img') as varchar) as `gallery`,
    dom_first_slim_html(dom, '#landingImage, #imgTagWrapperId img, #imageBlock img:expr(width > 400)') as `img`,
    dom_first_text(dom, '#price tr td:contains(List Price) ~ td') as `listprice`,
    dom_first_text(dom, '#price tr td:matches(^Price) ~ td') as `price`,
    str_first_float(dom_first_text(dom, '#reviewsMedley .AverageCustomerReviews span:contains(out of)'), 0.0) as `score`
from load_out_pages('https://www.amazon.com/b?node=3117954011', 'a[href~=/dp/]', 1, 10);
              </code>
     </pre>
                    <a href="http://bi.platonic.fun/question/41" class="btn-learn-more" target="_blank">执行</a>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Us Section -->


    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>关键难题</h2>
            </div>

            <div class="row content">
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        <b>网络数据处理存在以下关键理论难题</b>
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> <b>自动网页提取</b> - 无人干预自动结构化互联网规模网页</li>
                        <li><i class="ri-check-double-line"></i> <b>AI辅助网页提取</b> - 零干预或极少干预，将大规模网页完整精确结构化</li>
                    </ul>
                </div>
                <div class="col-lg-7 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <p>
                        <b>行为良好的企业级网络数据处理系统需要解决以下工程问题</b>
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> <b>增强分析</b> - 需要机器学习、知识图谱等AI技术来增强数据分析</li>
                        <li><i class="ri-check-double-line"></i> <b>机器学习</b> - 支持机器学习算法来降低数据处理门槛并提高效率</li>
                        <li><i class="ri-check-double-line"></i> <b>云化服务</b> - 支持云化服务以降低使用门槛并提高交付效率</li>
                        <li><i class="ri-check-double-line"></i> <b>操作语言</b> - 支持数据操作语言以简化远程数据操作</li>

                        <li><i class="ri-check-double-line"></i> <b>质量保证</b> - 系统质量保证，以及大规模采集下的数据质量保证</li>
                        <li><i class="ri-check-double-line"></i> <b>性能优化</b> - 采集单元容器化以最大化节点效率，修改浏览器内核以提升性能</li>
                        <li><i class="ri-check-double-line"></i> <b>弹性计算</b> - 支持弹性计算以实现无缝扩展，从而获得处理互联网规模数据的能力</li>
                        <li><i class="ri-check-double-line"></i> <b>健壮性</b> - 应对复杂的网络环境</li>

                        <li><i class="ri-check-double-line"></i> <b>存储处理</b> - 需要完整的工具链处理网络大数据的存储问题</li>
                        <li><i class="ri-check-double-line"></i> <b>运维工具</b> - 需要完整的运维工具以实时获取系统运行状态并对对系统进行诊断和维护</li>
                        <li><i class="ri-check-double-line"></i> <b>全流程</b> - 从采集网页等原始数据到结论形成、报表生成整个流程</li>

                        <li><i class="ri-check-double-line"></i> <b>其它问题</b> - 获取成本、技能要求、数据规模、数据融合、时效价值、可维护性等</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Us Section -->

    <!-- ======= Auto Web Mining Section ======= -->
    <section id="technology" class="about">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>智能挖掘</h2>
            </div>

            <div class="row content">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="150">
                    <p>
                        <b>零干预将网站还原为数据</b>
                    </p>
                    <p>
                        给定入口链接，柏拉图 AI 识别、浏览并解读最重要的链出页，输出<b>全部</b>字段：
                    </p>

                    <pre>
      <code class="language-sql">select * from harvest('https://www.amazon.com/b?node=3117954011');</code>
     </pre>
                </div>

                <div class="col" data-aos="fade-in" data-aos-delay="1200">
                    <div id="tables">
                        <p class="text-secondary">
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i> AI 已浏览<i
                                    class="px-2">120</i>个网页，已理解<i class="px-2">8</i>组数据共<i
                                    class="px-2">142</i>个字段。 以下显示第<i class="px-2">2</i>组数据，该组数据共包含<i
                                    class="px-2">10</i>个字段，对应网页区域 <i>#centerCol</i> <i
                                    class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>

                        <div class="table">
                        	<?php echo $this->element('auto-mining-result') ?>
                        </div>
                        <a href="http://platonic.fun/i/ai?url=aHR0cHM6Ly93d3cuYW1hem9uLmNvbS9CZXN0LVNlbGxlcnMtQXV0b21vdGl2ZS96Z2JzL2F1dG9tb3RpdmUvcmVmPXpnX2JzX25hdl8w"
                                class="btn-learn-more" target="_blank">执行 AI 自动挖掘</a>
                        <a href="http://platonic.fun/i/ai?mode=dev&url=aHR0cHM6Ly93d3cuYW1hem9uLmNvbS9CZXN0LVNlbGxlcnMtQXV0b21vdGl2ZS96Z2JzL2F1dG9tb3RpdmUvcmVmPXpnX2JzX25hdl8w"
                                class="btn-learn-more" target="_blank">执行 AI 辅助挖掘</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Auto Web Mining Section -->


    <!-- ======= Data API Section ======= -->
	<section id="saas" class="about">
		<div class="container">

			<div class="section-title" data-aos="fade-up">
				<h2>SAAS</h2>
			</div>

			<div class="row content">
				<div class="col-lg-7 pt-4 pt-lg-0" data-aos="fade-up"
					data-aos-delay="300">
					<pre>
      <code class="language-sql">curl -X POST --location "http://platonic.fun:8182/api/x/e" -H "Content-Type: text/plain" -d "
  select
      dom_base_uri(dom) as url,
      dom_first_text(dom, '#productTitle') as title,
      str_substring_after(dom_first_href(dom, '#wayfinding-breadcrumbs_container ul li:last-child a'), '&node=') as category,
      dom_first_slim_html(dom, '#bylineInfo') as brand,
      cast(dom_all_slim_htmls(dom, '#imageBlock img') as varchar) as gallery,
      dom_first_slim_html(dom, '#landingImage, #imgTagWrapperId img, #imageBlock img:expr(width > 400)') as img,
      dom_first_text(dom, '#price tr td:contains(List Price) ~ td') as listprice,
      dom_first_text(dom, '#price tr td:matches(^Price) ~ td') as price,
      str_first_float(dom_first_text(dom, '#reviewsMedley .AverageCustomerReviews span:contains(out of)'), 0.0) as score
  from load_and_select('https://www.amazon.com/dp/B07XJ8C8F7 -i 20s', 'body');"</code>
     </pre>
				</div>
				<div class="col-lg-5" data-aos="fade-up" data-aos-delay="150">
					<p>支持 X-SQL 的 REST API</p>
					<ul>
						<li><i class="ri-check-double-line"></i> <b>业务模型映射</b> - 使用 X-SQL
							完成从网页数据到本地业务模型的转换</li>
						<li><i class="ri-check-double-line"></i> <b>DATA API</b> -
							柏拉图的弹性计算使得规模化 Web 数据唾手可得</li>
						<li><i class="ri-check-double-line"></i> <b>高阶 SaaS</b> - X-SQL
							灵活的内置函数，提供进一步的数据处理能力：情绪判定，知识图谱构建等</li>
						<li><i class="ri-check-double-line"></i> <b>领域 SaaS</b> -
							对常见领域，柏拉图已内置开箱即用的解决方案</li>
					</ul>
					<a href="http://bi.platonic.fun" class="btn-learn-more"
						target="_blank">了解更多</a>
				</div>
			</div>

		</div>
	</section>
	<!-- End Data API -->


    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container">

            <div class="row">
                <div
                        class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start"
                        data-aos="fade-right" data-aos-delay="150">
                    <img src="img/counts-img.svg" alt="" class="img-fluid">
                </div>

                <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0"
                     data-aos="fade-left" data-aos-delay="300">
                    <div class="content d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="icofont-simple-smile"></i> <span><b
                                                data-toggle="counter-up">50</b><b
                                                style="font-size: smaller">%</b></span>
                                    <p>
                                        <strong>成本节约</strong>
                                        相比传统方案，使用柏拉图管理外部数据，我们至少为客户减少了一半人员开支和一半硬件投入
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="icofont-document-folder"></i> <span><b
                                                data-toggle="counter-up">20</b><b
                                                style="font-size: smaller">x</b></span>
                                    <p>
                                        <strong>数据规模</strong>
                                        基于柏拉图的机器学习技术，我们现在能够获得网站的几乎全部字段，并且再没有数据提取规则维护的烦恼
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="icofont-clock-time"></i> <span><b
                                                data-toggle="counter-up">90</b><b
                                                style="font-size: smaller">%</b></span>
                                    <p>
                                        <strong>交付时效</strong>
                                        柏拉图简单在万维网上应用商业智能，相比传统手段的采集规则制定、采集入库、数据清洗、BI 报表流程， 交付时效提高 90%
                                        以上
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="icofont-award"></i> <span><b data-toggle="counter-up">145</b><b
                                                style="font-size: smaller">%</b></span>
                                    <p>
                                        <strong>数据质量</strong> 传统手工提取数据，大概能够获得极少量网站的 50%
                                        左右字段，使用柏拉图前沿的数据挖掘技术，能够获得任意规模网站 95% 以上数据
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .content-->
                </div>
            </div>

        </div>
    </section>
    <!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="solutions" class="solutions">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>解决方案</h2>
                <p>告诉我们您在进行何种类型的项目</p>
            </div>

          <?php foreach (array_chunk($solutions, 4) as $chunk) : ?>
              <div class='row'>
                <?php foreach ($chunk as $solution): ?>

                    <div id="<?php echo $solution['Solution']['symbol'] ?>"
                         class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon">
                                <i class="bx bx-tachometer"></i>
                            </div>
                            <h4 class="title">
                                <a href=""><?php echo $solution['Solution']['title'] ?></a>
                            </h4>
                            <h6 class="description"><?php echo $solution['Solution']['description'] ?></h6>
                            <hr/>
                            <p><?php echo $solution['Solution']['content'] ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>
              </div>
          <?php endforeach; ?>

        </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= More Services Section ======= -->
    <section id="more-services" class="more-services">
        <div class="container">

            <div class="row">

                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card"
                         style='background-image: url("img/more-services-1.jpg");'
                         data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="">机器学习全部字段</a>
                            </h5>
                            <p class="card-text">


                            <pre>
        <code class="language-sql">select
    *
from
    harvest('https://www.amazon.com/b?node=3117954011')
</code>
       </pre>
                            </p>
                            <div class="read-more">
                                <a href="#"><i class="icofont-arrow-right"></i> Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="card"
                         style='background-image: url("img/more-services-2.jpg");'
                         data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="">百思买批量计算折扣</a>
                            </h5>
                            <p class="card-text">


                            <pre>
        <code class="language-sql">select
    dom_first_number(dom, '.priceView-customer-price') as `price`,
    dom_first_number(dom, '.pricing-price__regular-price') as `list-price`,
    dom_first_number(dom, '.pricing-price__regular-price') - dom_first_number(dom, '.priceView-customer-price') as `saving`
from
    load_out_pages('https://www.bestbuy.com/site/promo/laptop-and-computer-deals', 'h4.sku-header a')</code>
       </pre>
                            </p>
                            <div class="read-more">
                                <a href="#"><i class="icofont-arrow-right"></i> Read More</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 d-flex align-items-stretch mt-4">
                    <div class="card"
                         style='background-image: url("img/more-services-3.jpg");'
                         data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="">京东手机价格监测</a>
                            </h5>
                            <p class="card-text">


                            <pre>
        <code class="language-sql">select
    dom_first_text(dom, '.p-name') as Name,
    dom_first_text(dom, '.p-price') as Price,
    dom_first_text(dom, '.p-commit a:last-child') as Reviews
from load_and_select('https://list.jd.com/list.html?cat=9987,653,655 -expires 1d', 'li[data-sku]')</code>
       </pre>
                            </p>
                            <div class="read-more">
                                <a href="#"><i class="icofont-arrow-right"></i> Read More</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 d-flex align-items-stretch mt-4">
                    <div class="card"
                         style='background-image: url("img/more-services-4.jpg");'
                         data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="">亚马逊新品跟踪</a>
                            </h5>
                            <p class="card-text">


                            <pre>
        <code class="language-sql">select
    dom_first_text(dom, 'span.zg-item a > div:expr(img=0 && char>10)') as title,
    dom_first_text(dom, '.p13n-sc-price') as `price`,
    str_substring_between(dom_first_attr(dom, 'span.zg-item div a i.a-icon-star', 'class'), ' a-star-', ' ') as score
from load_and_select('https://www.amazon.com/gp/new-releases/home-garden/ref=zg_bsnr_nav_0', 'ol#zg-ordered-list li.zg-item-immersion')</code>
       </pre>
                            </p>
                            <div class="read-more">
                                <a href="#"><i class="icofont-arrow-right"></i> Read More</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
    <!-- End More Services Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>产品特性</h2>
                <p>柏拉图提供了一系列高级能力来解决客户面临的关键问题</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="300">
                <div class="col-lg-3 col-md-4">
                    <div class="icon-box">
                        <i class="ri-aliens-line" style="color: #ffbb2c;"></i>
                        <h3>
                            <a href="">自动网页挖掘</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                    <div class="icon-box">
                        <i class="ri-android-line" style="color: #5578ff;"></i>
                        <h3>
                            <a href="">机器学习</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                    <div class="icon-box">
                        <i class="ri-cpu-line" style="color: #e80368;"></i>
                        <h3>
                            <a href="">定制数据库内核</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <i class="ri-map-2-line" style="color: #e361ff;"></i>
                        <h3>
                            <a href="">知识图谱</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-database-line" style="color: #47aeff;"></i>
                        <h3>
                            <a href="">多存储支持</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-bar-chart-2-fill" style="color: #ffa76e;"></i>
                        <h3>
                            <a href="">商业智能</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-chrome-line" style="color: #11dbcf;"></i>
                        <h3>
                            <a href="">分布式网页渲染引擎</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-command-line" style="color: #4233ff;"></i>
                        <h3>
                            <a href="">REST API</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-qr-scan-2-fill" style="color: #b2904f;"></i>
                        <h3>
                            <a href="">完全分布式架构</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-braces-line" style="color: #b20969;"></i>
                        <h3>
                            <a href="">丰富的内置函数</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-slack-line" style="color: #ff5828;"></i>
                        <h3>
                            <a href="">多重扩展性</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mt-4">
                    <div class="icon-box">
                        <i class="ri-sun-line" style="color: #29cc61;"></i>
                        <h3>
                            <a href="">Monadic Function Service</a>
                        </h3>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Features Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>客户评价</h2>
                <p>他们这么说 。。。</p>
            </div>

            <div class="owl-carousel testimonials-carousel" data-aos="fade-up" data-aos-delay="200">

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="img/testimonials/testimonials-12.jpg"
                             class="testimonial-img" alt="">
                        <h3>杨锦全</h3>
                        <h4>总经理 &amp; 合伙人</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            使用柏拉图，我们现在每天采集一千万电商数据，相比原本预算，硬件成本减少了一半，产品研发周期缩短到了三个月。 <i
                                    class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="img/testimonials/testimonials-11.jpg"
                             class="testimonial-img" alt="">
                        <h3>徐玉海</h3>
                        <h4>总经理</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            使用柏拉图采集海外新闻数据后，团队可以把精力放到我们熟悉的舆情分析上，这为我们的团队管理效率带来了巨大提升。 <i
                                    class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

                <div class="testimonial-wrap">
                    <div class="testimonial-item">
                        <img src="img/testimonials/testimonials-14.jpg"
                             class="testimonial-img" alt="">
                        <h3>邱维明</h3>
                        <h4>总经理 &amp; 合伙人</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i> 柏拉图的 Web
                            数据管理系统使得我们的数据产品创意总可以在第一时间得到实现，客户常常惊讶于我们的原型交付能力。 <i
                                    class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio" style="display: none">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>案例演示</h2>
                <p>使用柏拉图，轻松获得目标数据。</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up"
                 data-aos-delay="400">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>App</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-1.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="App 1"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-2.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="Web 3"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>App</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-3.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="App 2"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 2</h4>
                            <p>Card</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-4.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="Card 2"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 2</h4>
                            <p>Web</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-5.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="Web 2"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>App</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-6.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="App 3"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 1</h4>
                            <p>Card</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-7.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="Card 1"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Card 3</h4>
                            <p>Card</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-8.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="Card 3"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Web 3</h4>
                            <p>Web</p>
                            <div class="portfolio-links">
                                <a href="img/portfolio/portfolio-9.jpg"
                                   data-gall="portfolioGallery" class="venobox" title="Web 3"><i
                                            class="bx bx-plus"></i></a> <a href="portfolio-details.html"
                                                                           title="More Details"><i
                                            class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Portfolio Section -->


    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container">

            <div class="section-title">
                <h2>参考价格方案</h2>
                <p>选择最适合您的方案</p>
            </div>

<?php
    $priceTable = array(
      "起步版" => array(10000, 0.03),
      "进阶版" => array(50000, 0.02),
      "企业版" => array(250000, 0.0065),
      "大数据版" => array(1000000, 0.0055),
      "平台版" => array(5000000, 0.0045),
      "基础设施" => array(50000000, 0.0025),
      "基础设施 加强 I 版" => array(100000000, 0.002),
      "基础设施 加强 II 版" => array(200000000, 0.0015),
      "基础设施 加强 III 版" => array(500000000, 0.001),
    )
?>

            <div class="row">
                <?php
                foreach ($priceTable as $name => $price):
                ?>
                    <div class="col-lg-4 col-md-6 mt-md-2">
                        <div class="box" data-aos="zoom-in-right" data-aos-delay="200">
                            <h3><?= $name ?></h3>
                            <h4>
                                <sup>¥</sup><?= number_format($price[0] * $price[1]) ?><span> / 月</span><!-- ¥45 -->
                            </h4>
                            <ul>
                                <li><b><?= number_format($price[0]) ?></b> 调用 / 月</li>
                                <li>+ ¥<b><?= $price[1] ?></b> 每额外请求</li>
                            </ul>
                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">立即购买</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>团队介绍</h2>
                <p></p>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="img/team/team-10.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href="https://www.weibo.com/galaxyeye"><i
                                            class="icofont-weibo"></i></a> <a
                                        href="https://www.twitter.com/galaxyeye8"><i
                                            class="icofont-twitter"></i></a> <a href=""><i
                                            class="icofont-instagram"></i></a> <a href=""><i
                                            class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>张斌</h4>
                            <span>总经理 &amp; 创始人</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="img/team/team-11.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a> <a href=""><i
                                            class="icofont-facebook"></i></a> <a href=""><i
                                            class="icofont-instagram"></i></a> <a href=""><i
                                            class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>姚尧</h4>
                            <span>首席运营官</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="img/team/team-12.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a> <a href=""><i
                                            class="icofont-facebook"></i></a> <a href=""><i
                                            class="icofont-instagram"></i></a> <a href=""><i
                                            class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>许飞龙</h4>
                            <span>首席咨询师</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="img/team/team-3.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a> <a href=""><i
                                            class="icofont-facebook"></i></a> <a href=""><i
                                            class="icofont-instagram"></i></a> <a href=""><i
                                            class="icofont-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>褚雪忠</h4>
                            <span>首席架构师</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Team Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>常见问题</h2>
            </div>

          <?php foreach ($faqs as $faq): ?>
              <div class="row faq-item d-flex align-items-stretch"
                   data-aos="fade-up" data-aos-delay="100">
                  <div class="col-lg-5">
                      <i class="ri-question-line"></i>
                      <h4><?php echo $faq['q'] ?></h4>
                  </div>
                  <div class="col-lg-7">
                      <p><?php echo $faq['a'] ?></p>
                  </div>
              </div>
              <!-- End F.A.Q Item-->
          <?php endforeach; ?>

        </div>
    </section>
    <!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>联系我们</h2>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6" data-aos="fade-up"
                     data-aos-delay="100">
                    <div class="contact-about">
                        <h3>柏拉图</h3>
                        <p>加入柏拉图，开启企业级 Web 数据管理革命。</p>
                        <div class="social-links">
                            <a href="https://weibo.com/galaxyeye" title="galaxyeye"
                               class="weibo" target="_blank"><i class="icofont-weibo"></i></a>
                            <a href="https://twitter.com/galaxyeye8" title="galaxyeye"
                               class="twitter" target="_blank"><i class="icofont-twitter"></i></a>
                            <a href="#" class="weixin" title="galaxyeye"><i
                                        class="icofont-chat"></i></a> <a
                                    href="https://github.com/platonai" title="platonai"
                                    class="github" target="_blank"><i class="icofont-github"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up"
                     data-aos-delay="200">
                    <div class="info">
                        <!--              <div>-->
                        <!--                <i class="ri-map-pin-line"></i>-->
                        <!--                <p>A42 Alen Street<br>Mars, NY 535022</p>-->
                        <!--              </div>-->

                        <div>
                            <i class="ri-mail-send-line"></i>
                            <p>galaxyeye@live.cn</p>
                        </div>

                        <div>
                            <i class="ri-phone-line"></i>
                            <p>+86🌱186❧2153☙8660</p>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 col-md-12" data-aos="fade-up"
                     data-aos-delay="300">
                    <form action="forms/contact.php" method="post" role="form"
                          class="php-email-form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="姓名" data-rule="minlen:4"
                                   data-msg="Please enter at least 4 chars"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="邮件" data-rule="email"
                                   data-msg="Please enter a valid email"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject"
                                   id="subject" placeholder="主题" data-rule="minlen:4"
                                   data-msg="Please enter at least 8 chars of subject"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
       <textarea class="form-control" name="message" rows="5"
                 data-rule="required" data-msg="Please write something for us"
                 placeholder="说点什么 ..."></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <!--              <div class="text-center"><button type="submit">发送</button></div>-->
                    </form>
                </div>

            </div>

        </div>
    </section>
    <!-- End Contact Section -->

</main>
<!-- End #main -->
