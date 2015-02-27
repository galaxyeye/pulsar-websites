<?php 
	$this->set('title_for_layout', '推荐好友 - 赚金豆 - 乐够乐透网');
	
	$friend_url = 'http://www.logoloto.com/';
	if ($currentUser['id'] != 0) {
		$friend_url .= 'invite/'.$currentUser['id'];
	}
?>

<div class="content-header">
	<div class="aads-nav">
		<?php echo $html->link('', '/ad_aqs/', array('class' => 'nav nav1')) ?>
		<?php echo $html->link('', '/ad_gotchas/', array('class' => 'nav nav2')) ?>
		<?php echo $html->link('', '/invite', array('class' => 'nav nav3')) ?>
	</div>
</div>

<div class="content-list">
	<div id="friend-tip">每成功邀请一位好友<span class="ledou-img" title="金豆"></span><span class="ledou-num">+<?php echo NOMINATE_LEDOU;?></span></div>
	<div id="friend">
       	<div class="friend-title">推荐好友加入乐够乐透网</div>
        <div class="friend-description">请使用Ctrl+C或右键复制链接地址，通过QQ、MSN等发送给你的朋友。</div>
        <input type="text" size="60" value="<?php echo $friend_url?>" onclick="this.focus();this.select();" />
        <div style="clear:both;"></div>
	</div>
</div>
