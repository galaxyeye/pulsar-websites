<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">亚马逊解决方案</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">
                	精准的采集时间<br />
                	全面的数据字段<br />
                	严格的数据质量<br />
                	亚马逊即数据库<br />
                </h2>
                <div></div>
                <div data-aos="fade-up" data-aos-delay="800">
                	 <?php echo $this->Html->link(__('价格', true), '/#pricing', array('class' => 'btn-get-started')); ?>
                    <a class="btn-get-started" href="http://bi.platonic.fun/browse/38" target="_blank">默认方案</a>
                    <a class="btn-get-started" href="http://bi.platonic.fun/collection/4" target="_blank">实时采集</a>
                </div>
            </div>

            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                <!--                -->
<!--                <img src="../img/hero-img.png" class="img-fluid animated" alt="">-->
                <ul>
                    <li><b>Best Seller</b>&nbsp;<span>每日更新，约 25,000 类目，约 4,000,000 ASIN 关键数据</span></li>
                    <li><b>Most Wished For</b>&nbsp;<span>每日更新，约 25,000 类目，约 3,500,000 ASIN 关键数据</span></li>
                    <li><b>New Releases</b>&nbsp;<span>约 每日更新，25,000 类目，约 3,000,000 ASIN 关键数据</span></li>
                    <li><b>Movers and Shakers</b>&nbsp;<span>每小时更新</span></li>
                    <li><b>ASIN</b>&nbsp;<span>每日更新</span>
                    	<ul>
                    		<li>200+字段</li>
                    		<li>价格，描述，店铺，跟买</li>
                    		<li>广告商品，相似商品，推荐商品</li>
                    		<li>评分信息</li>
                    		<li>主要评论，关键词等</li>
                    	</ul>
                    </li>
                    <li><b>Review</b>&nbsp;<span>每日更新</span></li>
                    <li>所有数据均可实时采集</li>
                </ul>
            </div>
        </div>
    </div>

</section>
<!-- End Hero -->

<main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>方案简介</h2>
            </div>

            <div class="row content">
                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="150">
                    <ul>
                        <li><i class="ri-check-double-line"></i> <b>完整的数据模型</b> - 50+ 数据表，1000+ 字段
                        </li>
                        <li><i class="ri-check-double-line"></i> <b>精确的采集调度</b> - 按天、小时、分钟调度，或者设置采集时间
                        </li>
                        <li><i class="ri-check-double-line"></i> <b>全站点覆盖能力</b> -
                            亚马逊美国，英国，加拿大，日本，每一个站点均有效采集，数据精确到地区
                        </li>
                        <li><i class="ri-check-double-line"></i> <b>严格的质量保障</b> - 严格的数据质量保障体系，确保采集时间的精准、字段正确、链接分配正确、页面状态正确</li>
                    </ul>
                </div>
                <div class="col-lg-7 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
     <pre>
      <code class="language-sql">
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
     </pre><a href="http://bi.platonic.fun/question/41" class="btn-learn-more" target="_blank">执行</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us Section -->

</main>
<!-- End #main -->
