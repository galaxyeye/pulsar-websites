<div class="pageEntities form">
<?php echo $this->Form->create('PageEntity');?>
	<fieldset>
 		<legend>
 			<?php __('Edit Page Entity'); ?>
 		</legend>
	<?php

    $m = [
        'name' => '<p class="m hidden">网页实体名，默认自动生成。</p>',

    		'block_path' => "<p class='m hidden'>网页实体区域的CSS路径。</p>",
        'url_filter' => "<p class='m hidden'>由多行正则表达式来表达的目标url模式，每行一个正则表达式。留空或不修改表示不过滤。
          <br />正则表达式前可以有前缀'+'或者'-'，前缀'+'可以省略。
          <br />前缀'+'表示符合该模式的链接<strong class='green'>需要</strong>被抽取。
          <br />前缀'-'表示符合该模式的链接<strong class='red'>不能</strong>被抽取。
        </p>",
        'text_filter' => "<p class='m hidden'>由一个json对象定义的页面文本过滤器，请直接修改模板。留空或不修改表示不过滤。
          <br />仅页面文本满足该对象指定的四个条件时，该页面内的链接才会被加入到下一轮抓取列表。
          <br />四个条件分别为：包含所有，包含任一，不包含组合，不包含任一。关键词之间用半角逗号(,)全角逗号(，)或者空格分隔。
        </p>",
    ];

    $now = date('Ymd-His');
    $namePostfix = $currentUser['id'].'-'.$now;
    $defaultName = 'PageEntity-'.$namePostfix;
    $defaultName = preg_replace("/\s+/", "-", $defaultName);
    $maxModels = 10;

    global $urlFilterTemplate, $textFilterTemplate;

    /***********************************************************/
    echo $this->Form->input('name', array('value' => $defaultName, 'after' => $m['name'] ));
    echo $this->Form->input('block_path', array('value' => ':root', 'after' => $m['block_path']));
    echo $this->Form->input('url_filter', array('options' => $urlFilters,
    		'value' => symmetric_encode($this->Form->value('PageEntity.url_filter')),
    		'div' => 'input select medium filter', 'after' => $m['url_filter']));
    echo $this->Form->input('url_filter', array('id' => 'PageEntityUrlFilter2', 
    		'type' => 'textarea', 'disabled' => 'disabled', 'div' => 'input text medium filter hidden', 'after' => $m['url_filter']));
    //    echo $this->Form->input("text_filter", array('value' => $textFilterTemplate, 'after' => $m['text_filter']));
    echo $this->Form->input("text_filter", array('options' => $textFilters, 
    		'value' => symmetric_encode($this->Form->value('PageEntity.text_filter')),
    		'div' => 'input select medium filter', 'after' => $m['text_filter']));
    echo $this->Form->input("text_filter", array('id' => 'PageEntityTextFilter2', 'type' => 'textarea', 'disabled' => 'disabled', 'div' => 'input text medium filter hidden', 'after' => $m['text_filter']));
    echo $this->Form->input('description', array('rows' => '1'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('PageEntity.id')));?></li>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PageEntity.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PageEntity.id'))); ?></li>
  </ul>
</div>
