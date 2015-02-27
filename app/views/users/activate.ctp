<?php 
	$this->set('title_for_layout', '帐户激活 - 乐够乐透网');
?>
			<div id="active-frame">
				<div class="active-box">
					<?php if (true || isset($result) && $result == 'activated') : ?>
					<div class="congratulation">恭喜你，你的帐户已被激活！请到你的<?php echo $html->link('个人空间', '/profiles/basic') ?>填写个人资料，以获得中奖机会。</div>
					<div class="redirect"><span id="tick">30</span>秒钟后自动跳转到个人空间</div>
					<div class="go-ahead">
					  <?php echo $html->link('进入个人空间', '/profiles/basic') ?>
					  <?php echo $html->link('返回首页', '/') ?>
					</div>
					<?php else : ?>
  					<div class="active-info">
  					<?php echo $message?>
  					</div>
  					<?php echo $html->link('', array('controller' => 'users', 'action' => 'login'), array('class' => 'active-button'));?>
					<?php endif; ?>
				</div>
			</div>

<? 
if (isset($channel)) {
	App::import('Lib', 'promotion_manager');

	if ($channel['channel_id'] == PRO_LINKTECH) {
		// linktech
		$lt_merchant_id = 'logoloto';
		$lt_merchant_member = $currentUser['id'];
		$lt_merchant_name = $currentUser['name'];
		$lt_order_code 	= $currentUser['id'];
		$lt_product_code = 'linktech';
		$LTINFO = $channel['info'];

		echo
			"<script src=\"http://service.linktech.cn/purchase_cpa.php?a_id=$LTINFO&m_id=$lt_merchant_id&mbr_id=$lt_merchant_member($lt_merchant_name)&o_cd=$lt_order_code&p_cd=$lt_product_code\"></script>";
	}
	else if ($channel['channel_id'] == PRO_CHANET) {
		echo "<img src='http://count.chanet.com.cn/action.cgi?t=4838&i={$currentUser['id']}' width=1 height=1>";
	}
	else if ($channel['channel_id'] == PRO_WEIYI) {
		
	}
}
?>

<script type="text/javascript">
<!--
var t = 30;
var timer = null;

function goAhead() {
	if (t-- > 0) {
		document.getElementById('tick').innerHTML = t;
	}
	else {
		document.getElementById('tick').innerHTML = 0;
		if (timer != null) clearInterval(timer);

		window.location = "<?php echo $this->base.'/profiles/basic' ?>";
	}
}

try {
 (function() {timer = setInterval("goAhead()", 1000);})();
}
catch(err) {
	
}

//-->
</script>
