<?php echo $this->element('crawls/subnav') ?>

<div class='message start-up-tip hidden'>
    说明：
    <br/>I. 本页面提供完整的爬虫控制
    <br/>II. 任务创建完毕后，可以通过编辑界面深度控制爬虫行为以满足其他需求
</div>
<div class="crawls form auto-validate">
    <div class='help small gray right'>帮助</div>
    <?php echo $this->Form->create('Crawl'); ?>
    <h2><?php __('创建通用爬虫任务'); ?></h2>
    <?php
    $m = [
        'name' => '<p class="m hidden">任务名称，默认自动生成</p>',
        'crawlId' => '<p class="m hidden">任务主表，默认值由系统配置</p>',
        'crawl_mode' => '<p class="m hidden">是否支持Ajax</p>',
        'rounds' => '<p class="m hidden">爬虫采用广度优先算法，即：<br />
						  I : 爬种子链接，得到第一层网页集；<br />
						 II : 抽取第一层网页集中的URL，作为第二层网页集合的种子，并开始爬第二层网页；<br />
						III : 反复重复I, II两个步骤N遍，或者再无新链接，结束抓取。
					</p>',
        'frequency' => '<p class="m hidden">抓取频率。单位：分钟。</p>',
        'description' => '<p class="m hidden">对本次抓取任务的简单说明。</p>',
        'Seed.url' => '<p class="m hidden">爬虫入口。每行一个链接。</p>',

        'url_filter' => "<p class='m hidden'>由多行正则表达式来表达的目标url模式，每行一个正则表达式。留空或不修改表示不过滤。
  				<br />正则表达式前可以有前缀'+'或者'-'，前缀'+'可以省略。
  				<br />前缀'+'表示符合该模式的链接<strong class='green'>需要</strong>被抓取。
  				<br />前缀'-'表示符合该模式的链接<strong class='red'>不能</strong>被抓取。
  			</p>",
        'text_filter' => "<p class='m hidden'>由一个json对象定义的页面文本过滤器，请直接修改模板。留空或不修改表示不过滤。
  			<br />仅页面文本满足该对象指定的四个条件时，该页面内的链接才会被加入到下一轮抓取列表。
			<br />四个条件分别为：包含所有，包含任一，不包含组合，不包含任一。关键词之间用半角逗号(,)全角逗号(，)或者空格分隔。
  		  </p>",
        'block_filter' => "<p class='m hidden'>目前仅支持CSS Selector，暂不支持CSS Path。
				<br />由一个json对象定义的页面区域过滤器，请直接修改模板。留空或不修改表示不过滤。
  				<br />仅allow指定的区域内的链接将会被加入到下一轮抓取列表，
  			    <br />而disallow指定的区域则不会被加入到下一轮抓取列表。</p>",

        'WebAuthorization.login_url' => "<p class='m hidden'>登录页面链接</p>",
        'WebAuthorization.account_css_selector' => "<p class='m hidden'>账户框的CSS选择器</p>",
        'WebAuthorization.account' => "<p class='m hidden'>登录名</p>",
        'WebAuthorization.password_css_selector' => "<p class='m hidden'>密码框CSS选择器</p>",
        'WebAuthorization.password_text' => "<p class='m hidden'>密码明文文本</p>",

        'HumanAction.order' => "<p class='m hidden'>执行顺序</p>",
        'HumanAction.css_path' => "<p class='m hidden'>触发事件的对象的css path</p>",
        'HumanAction.action' => "<p class='m hidden'>事件</p>",
        'HumanAction.keyCode' => "<p class='m hidden'>键盘事件发生时的键值</p>"
    ];

    $maxModels = 10;

    $defaultCrawlName = "crawl-" . date('Ymd-His');
    $defaultCrawlName = preg_replace("/\\s+/", "-", $defaultCrawlName);
    $defaultLoginUrl = "http://www.example.com/login";
    $defaultAccount = "account";
    $defaultPassword = "password";

    global $jsEvents, $seedTemplate, $urlFilterTemplate, $textFilterTemplate, $blockFilterTemplate;

    /***********************************************************/
    echo "<fieldset class='crawl'><legend>爬虫信息</legend>";
    echo $this->Form->input('name', array('label' => '任务名称', 'default' => $defaultCrawlName, 'after' => $m['name']));
    echo $this->Form->input('crawlId', array('label' => 'crawlId', 'default' => STORAGE_CRAWL_ID_VALUE, 'after' => $m['crawlId']));
    echo $this->Form->input('solrCollection', array('label' => 'solrCollection', 'default' => SOLR_COLLECTION, 'after' => $m['crawlId']));
    echo $this->Form->input('crawl_mode', array('label' => 'Ajax Support',
        'default' => "CROWDSOURCING",
        'options' => ['NATIVE' => 'Without Ajax Support', 'CROWDSOURCING' => 'With Ajax Support'],
        'after' => $m['crawl_mode']));
    echo $this->Form->input('Seed.0.url', array('label' => '入口链接', 'value' => $seedTemplate, 'after' => $m['Seed.url']));
    echo $this->Form->input('rounds', array('label' => '抓取周期数', 'default' => 100, 'after' => $m['rounds']));
    echo $this->Form->input('frequency', array('label' => '抓取频率', 'default' => -1, 'after' => $m['frequency']));
    echo $this->Form->input('description', array('label' => '简单说明', 'rows' => '1', 'after' => $m['description']));
    echo "</fieldset>";

    /***********************************************************/
    echo "<fieldset class='related crawl-filter' models='1' min-models='1' max-models='$maxModels'>";
    echo "<legend>过滤器</legend>";
    for ($i = 0; $i < $maxModels; ++$i) {
        $no = $i + 1;
        $class = ($i > 0) ? 'fieldset hidden' : 'fieldset';
        $disabled = ($i > 0) ? 'disabled' : '';
        echo "<div class='$class i_$i'>";
        echo "<h3>$no.</h3>";

        echo $this->Form->input("CrawlFilter.$i.url_filter", array('value' => $urlFilterTemplate, 'after' => $m['url_filter'], 'disabled' => $disabled));
        echo $this->Form->input("CrawlFilter.$i.text_filter", array('value' => $textFilterTemplate, 'after' => $m['text_filter'], 'disabled' => $disabled));
        echo $this->Form->input("CrawlFilter.$i.block_filter", array('value' => $blockFilterTemplate, 'after' => $m['block_filter'], 'disabled' => $disabled));
        echo "</div>";
    }
    // 	echo $this->Form->button('+', array('type' => 'button', 'class' => 'add'));
    // 	echo $this->Form->button('-', array('type' => 'button', 'class' => 'del'));
    echo "</fieldset>";

    /***********************************************************/
    echo "<fieldset class='related web-authorization' models='1' min-models='0' max-models='$maxModels'>";
    echo "<legend>验证信息</legend>";
    for ($i = 0; $i < $maxModels; ++$i) {
        $no = $i + 1;
        $class = ($i > 0) ? 'fieldset hidden' : 'fieldset';
        $disabled = ($i > 0) ? 'disabled' : '';
        echo "<div class='$class i_$i'>";
        echo "<h3>$no.</h3>";

        echo $this->Form->input("WebAuthorization.$i.login_url", array('label' => '登录页面', 'value' => $defaultLoginUrl, 'after' => $m['WebAuthorization.login_url'], 'disabled' => $disabled));
        echo $this->Form->input("WebAuthorization.$i.account_css_selector", array('label' => '账户的CSS选择器', 'value' => '#account', 'after' => $m['WebAuthorization.account_css_selector'], 'disabled' => $disabled));
        echo $this->Form->input("WebAuthorization.$i.account", array('label' => '用户名', 'value' => $defaultAccount, 'after' => $m['WebAuthorization.account'], 'disabled' => $disabled));
        echo $this->Form->input("WebAuthorization.$i.password_css_selector", array('label' => '密码的CSS选择器', 'value' => '#password', 'after' => $m['WebAuthorization.password_css_selector'], 'disabled' => $disabled));
        echo $this->Form->input("WebAuthorization.$i.password_text", array('label' => '密码', 'value' => $defaultPassword, 'after' => $m['WebAuthorization.password_text'], 'disabled' => $disabled));
        echo "</div>";
    }
    echo $this->Form->button('+', array('type' => 'button', 'class' => 'add'));
    echo $this->Form->button('-', array('type' => 'button', 'class' => 'del'));
    echo "</fieldset>";

    /***********************************************************/
    echo "<fieldset class='related human-action' models='1' min-models='0' max-models='$maxModels'>";
    echo "<legend>拟人行为</legend>";
    for ($i = 0; $i < $maxModels; ++$i) {
        $no = $i + 1;
        $class = ($i > 0) ? 'fieldset hidden' : 'fieldset';
        $disabled = ($i > 0) ? 'disabled' : '';
        echo "<div class='$class i_$i'>";
        echo "<h3>$no.</h3>";

        echo $this->Form->input("HumanAction.$i.order", array('label' => '执行顺序', 'value' => $i + 1, 'after' => $m['HumanAction.order'], 'disabled' => $disabled));
        echo $this->Form->input("HumanAction.$i.css_path", array('label' => '执行对象', 'value' => ':root', 'after' => $m['HumanAction.css_path'], 'disabled' => $disabled));
        echo $this->Form->input("HumanAction.$i.action", array('label' => '执行动作', 'options' => array_combine($jsEvents, $jsEvents), 'default' => 'click', 'after' => $m['HumanAction.action'], 'disabled' => $disabled));
        echo $this->Form->input("HumanAction.$i.keyCode", array('label' => '键盘输入', 'maxLength' => 1, 'after' => $m['HumanAction.keyCode'], 'disabled' => $disabled));
        echo "</div>";
    }
    echo $this->Form->button('+', array('type' => 'button', 'class' => 'add'));
    echo $this->Form->button('-', array('type' => 'button', 'class' => 'del'));
    echo "</fieldset>";
    ?>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Crawls', true), array('action' => 'index')); ?></li>
    </ul>
</div>
