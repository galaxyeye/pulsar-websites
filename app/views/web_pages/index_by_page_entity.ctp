<div class="pageEntities view">
  <h2><?php  __('Page Entity');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['id']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['name']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url Filter'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['url_filter']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text Filter'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo $pageEntity['PageEntity']['text_filter']; ?></pre>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Block Path'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['block_path']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['status']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['description']; ?>
      &nbsp;
    </dd>
  </dl>
</div>

<div class="actions">
  <ul>
    <li><?php echo $this->Html->link(__('View Page Entity', true), 
    		array('controller' => 'page_entities', 'action' => 'view', $pageEntity['PageEntity']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('Edit Page Entity', true), 
    		array('controller' => 'page_entities', 'action' => 'edit', $pageEntity['PageEntity']['id'])); ?> </li>
  </ul>
</div>

<div class='related start-tip larger green'>点击任一链接，制定挖掘规则。</div>

<div class="webPages index">
	<h2>
    <span><?php __('Web Page Link Map');?></span>
    <p class="m hidden">TODO：链接地图可视化</p>
	</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Base Url</th>
	</tr>
	<?php 
	$i = 0;
	foreach ($webPages as $webPage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$page_entity_id = $pageEntity['PageEntity']['id'];
		$encodedUrl = symmetric_encode($webPage['baseUrl']);
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i ?></td>
		<td class='pageInfo'>
		  <div><?=$this->Html->link($webPage['baseUrl'],
					['action' => 'view', $encodedUrl, 'page_entity_id' => $page_entity_id],
		  		['target' => '_blank']); ?>&nbsp;</div>

		</td>
	</tr>
	<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Search Web', true), array('action' => 'search')); ?></li>
	</ul>
</div>
