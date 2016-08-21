<style>
	.settings table tr th { width : 20em; }
	.settings table tr td { text-align: left; }
	.settings table tr td input[type="radio"] { margin: 0	}
</style>

<nav class="two columns" id="actions-sidebar">
	<ul class="side-nav">
		<li><a>浏览器提醒</a></li>
		<li><a>修改密码</a></li>
	</ul>
</nav>

<div class="settings ten columns content">
	<table class="vertical-table">
		<tr>
			<th>浏览器提醒</th>
			<td>
				<?= $this->Form->input("browserMessage", ['options' => ['开启', '关闭'], 'default' => '开启', 'type' => 'radio']) ?>
			</td>
		</tr>
		<tr>
			<th>浏览器声音提醒</th>
			<td>
				<?= $this->Form->input("browserMessageSound", ['options' => ['开启', '关闭'], 'default' => '开启', 'type' => 'radio']) ?>
			</td>
		</tr>
		<tr>
			<th>APP提醒</th>
			<td>
				<?= $this->Form->input("appMessage", ['options' => ['开启', '关闭'], 'default' => '开启', 'type' => 'radio']) ?>
			</td>
		</tr>
		<tr>
			<th>主题</th>
			<td>
				<?= $this->Form->input("topic", [
					'label' => false,
					'class' => 'medium',
					'options' => ['主题１', '主题2', '主题3', '主题4']
				])
				?>
			</td>
		</tr>
		<tr>
			<th>预警等级</th>
			<td>
				<?= $this->Form->input("alertLevel", ['label' => false, 'options' => ['全部', '一级', '二级', '三级', '四级', '正常数据'], 'multiple' => true]) ?>
			</td>
		</tr>
		<tr>
			<th>资源类型</th>
			<td>
				<?= $this->Form->input("sourceCategory", ['label' => false, 'options' => ['全部', '资讯', '微博', '论坛', '贴吧', '博客', '视频', '微信'], 'multiple' => true]) ?>
			</td>
		</tr>
		<tr>
			<th>多久提醒一次</th>
			<td>
				<?= $this->Form->input("messagePeriod", ['options' => ['实时', '1分钟', '5分钟', '10分钟'], 'type' => 'radio']) ?>
			</td>
		</tr>
		<tr>
			<th>相似数据只提醒一次</th>
			<td>
				<?= $this->Form->input("showSimilarMessage", ['options' => ['是', '否'], 'type' => 'radio']) ?>
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><a>恢复默认设置</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="button">确定</button>
			</td>
		</tr>
	</table>
</div>
