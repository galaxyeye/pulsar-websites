<div class="filter datetime cl">
	<div class="columns">
		<span>时间：</span>
		<?= $this->Html->link("今天", ['action' => 'monitor', $topic['Topic']['id']]) ?>
		<?= $this->Html->link("昨天", ['action' => 'monitor', $topic['Topic']['id']]) ?>
		<?= $this->Html->link("最近七天", ['action' => 'monitor', $topic['Topic']['id']]) ?>
		<span class="ui-datepicker"></span>
		<span></span>
	</div>
	<div class="one column"><button>确定</button></div>
	<div class="column"></div>
</div>

<div>
	本文没有被传播！
</div>
