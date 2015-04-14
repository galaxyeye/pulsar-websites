<?php echo $this->element('page_entities/subnav') ?>
<?php $page_entity_id = $pageEntity['PageEntity']['id']; ?>

<div class="pageEntities view">
  <h2><?php  __('Page Entity');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <span class='model-id'><?php echo $pageEntity['PageEntity']['id']; ?></span>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['name']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url Filter'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo $pageEntity['PageEntity']['url_filter']; ?></pre>
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

<?php $regex = $pageEntity['PageEntity']['url_filter']; ?>

<div class="actions">
  <ul>

    <li><?php echo $this->Html->link(__('View Extract Result', true),
        ['controller' => 'storage_page_entities', '?' => ['regex' => $regex]], ['target' => '_blank']); ?></li>

    <li><?php echo $this->Html->link(__('New Page Entity', true),
        ['action' => 'add', 'crawl_id' => $pageEntity['PageEntity']['crawl_id']], ['target' => '_blank']); ?></li>

    <li><?php echo $this->Html->link(__('Edit Page Entity', true),
        ['action' => 'edit', $pageEntity['PageEntity']['id']], ['target' => '_blank']); ?></li>

    <li><?php echo $this->Html->link(__('Delete Page Entity', true),
        ['action' => 'delete', $pageEntity['PageEntity']['id']], null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['PageEntity']['id'])); ?></li>

    <li><?php echo $this->Html->link(__('View Jobs', true),
        ['controller' => 'scent_jobs'], ['target' => '_blank']); ?></li>

    <li><?php echo $this->Html->link(__('View XML', true),
        ['action' => 'viewXml', $pageEntity['PageEntity']['id']], ['target' => '_blank']); ?></li>
  </ul>
</div>

<div class='related message'>
	<h3>Minging Help</h3>
	<ol>
		<li>Rule based mining engine requires minging rules,
		the rules can be automatically generated, and you can modifiy, delete, or add new ones manually</li>
		<li>Auto mining engine does NOT require any additional rules, but it's experimental</li>
	</ol>
</div>

<div class="pageEntities form">
<?php echo $this->Form->create('PageEntity', array('action' => 'startAutoExtract', 'type' => 'get')); ?>
  <fieldset>
    <legend><?php __('Start Auto Minging (Experimental)'); ?></legend>
  <?php echo $this->Form->input('id', array('value' => $pageEntity['PageEntity']['id'])); ?>
  <?php echo $this->Form->hidden('domain', array('value' => 'product')); ?>
  <?php echo $this->Form->hidden('limit', array('value' => 500)); ?>
  <?php echo $this->Form->hidden('builder', array('value' => 'ProductHTMLBuilder')); ?>
  <?php echo $this->Form->end(__('Start Auto Minging', true)); ?>
  </fieldset>
</div>

<div class="related">
  <h3><?php __('Page Entity Fields');?></h3>
  <?php if (!empty($pageEntity['PageEntityField'])): ?>
  <table cellpadding="0" cellspacing="0">
  <tr>
    <th><?php __('Name'); ?></th>
    <th><?php __('Extractor Class'); ?></th>
    <th><?php __('Block Path'); ?></th>
    <th><?php __('Text Extract Regex'); ?></th>
    <th><?php __('Text Validate Regex'); ?></th>
    <th><?php __('Sql Data Type'); ?></th>
    <th class="actions"><?php __('Actions');?></th>
  </tr>
  <?php 
    $i = 0;
    foreach ($pageEntity['PageEntityField'] as $pageEntityField) : 
      $class = null;
      if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
      }
    ?>
    <tr<?php echo $class;?>>
      <td><?php echo $pageEntityField['name'];?></td>
      <td><?php echo $pageEntityField['extractor_class'];?></td>
      <td><?php echo $pageEntityField['css_path'];?></td>
      <td><?php echo $pageEntityField['text_extract_regex'];?></td>
      <td><?php echo $pageEntityField['text_validate_regex'];?></td>
      <td><?php echo $pageEntityField['sql_data_type'];?></td>
      <td class="actions">
        <?php echo $this->Html->link(__('View', true),
            ['controller' => 'page_entity_fields', 'action' => 'view', $pageEntityField['id']]); ?>
        <?php echo $this->Html->link(__('Delete', true),
            ['controller' => 'page_entity_fields', 'action' => 'delete', $pageEntityField['id']], null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntityField['id'])); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li><?php echo $this->Html->link(__('Analysis Minging Rules', true),
          [
          		'controller' => 'storage_web_pages',
          		'action' => 'index',
          		'?' => ['regex' => $regex, 'page_entity_id' => $page_entity_id]
          ],
          ['target' => '_blank']);?></li>
      <li><?php echo $this->Html->link(__('Manual Add Ming Rules', true),
          ['controller' => 'page_entity_fields', 'action' => 'add', "page_entity_id" => $page_entity_id],
      		['target' => '_blank']);?></li>
    </ul>
  </div>
</div>

<div class="pageEntities form">
<?php echo $this->Form->create('PageEntity', array('action' => 'startRuledExtract', 'type' => 'get'));?>
  <fieldset>
    <legend><?php __('Start Ruled Minging'); ?></legend>
  <?php echo $this->Form->input('id', array('value' => $pageEntity['PageEntity']['id'])); ?>
  <?php echo $this->Form->hidden('limit', array('value' => 500)); ?>

  <?php 
    if (!empty($pageEntity['PageEntityField'])) {
      echo $this->Form->end(__('Start Ruled Minging', true));
    }
    else {
      echo "No Mining Rules Yet";
    }
  ?>
  </fieldset>
</div>

<!-- 
<div class="pageEntities form">
<?php echo $this->Form->create('PageEntity', array('action' => 'startFeatureAnalysis', 'type' => 'get'));?>
  <fieldset>
    <legend><?php __('Feature Analysis'); ?></legend>
  <?php echo $this->Form->input('id', array('value' => $pageEntity['PageEntity']['id'])); ?>
  <?php echo $this->Form->hidden('limit', array('value' => 500)); ?>
  <?php echo $this->Form->hidden('diagnose', array('value' => true)); ?>
  </fieldset>
</div>
 -->
