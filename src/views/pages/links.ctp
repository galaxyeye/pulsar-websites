<?php 
	$this->set('title_for_layout', '合作方 - 乐够乐透网');
	$html->scriptBlock('$(document).ready(function(){$("#framenFB1F2_center_content").load("../enterprises #enterprise_list");});', 
		array('inline' => false));
?>
<style>
#framenFB1F2 {border:0;}
#framenFB1F2_left {width:220px;}
#framenFB1F2_left div {border:1px solid #ddd; margin:3px; height:13px; vertical-align:middle; padding:9px 0;}
#framenFB1F2_left div img {margin:0 25px 0 25px; width:11px; height:11px;}
#framenFB1F2_left div a {color:#666666; text-decoration:none;}
#framenFB1F2_left div a:hover {color:#ff6f0f;}
#framenFB1F2_left div a#current {color:#ff6f0f;}
#framenFB1F2_center {background-color:#fff9f4; width:700px; padding:15px; line-height:25px;}
#framenFB1F2_center_content {padding:20px 0;}
h1 {line-height:40px; border-bottom:3px solid #FF6F0F; font-size:14px; padding-left:10px;}
#framenFB1F2_center_content ol {margin-left:20px;}
#framenFB1F2_center_content ol li {margin:10px 0;}
#framenFB1F2_center_content ul {margin-left:10px;}
#framenFB1F2_center_content ul li {line-height:18px;}


#enterprises_list #enterprise_list {width:650px; margin:0;}
#enterprises_list #enterprise_list li {width:129px;}
</style>

<div id="enterprises_list" class="area">
	<div id="framenFB1F2" class="frame move-span cl frame-1-3">
		<div id="framenFB1F2_left" class="column frame-1-3-l">
			<div><img src="../img/common/icon2.gif"/><a href="about">关于我们</a></div>
			<div><img src="../img/common/icon2.gif"/><a href="disclaimer">免责声明</a></div>
			<div><img src="../img/common/icon2.gif"/><a href="privacy_policy">隐私条例</a></div>
			<div><img src="../img/common/icon2.gif"/><a href="cooperation">企业合作</a></div>
			<div><img src="../img/common/icon2.gif"/><a href="utility">公益事业</a></div>
			<div><img src="../img/common/icon2.gif"/><a href="service">客户服务</a></div>
			<div><img src="../img/common/icon2.gif"/><a href="links" id="current">合作方</a></div>
		</div>
		<div id="framenFB1F2_center" class="column frame-1-3-r">
			<h1>合作方</h1>
			<div id="framenFB1F2_center_content" class="content">
				
			</div>
		</div>
	</div>
</div>