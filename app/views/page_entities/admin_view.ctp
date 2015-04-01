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

<div class="actions">
  <ul>
    <li><?php echo $this->Html->link(__('View XML', true), array('action' => 'viewXml', $pageEntity['PageEntity']['id']), array('target' => '_blank')); ?> </li>
    <li><?php echo $this->Html->link(__('New Page Entity', true), array('action' => 'add', $pageEntity['PageEntity']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('Edit Page Entity', true), array('action' => 'edit', $pageEntity['PageEntity']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('Delete Page Entity', true), array('action' => 'delete', $pageEntity['PageEntity']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['PageEntity']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('View Jobs', true), array('controller' => 'scent_jobs'),array('target' => '_blank')); ?> </li>
  </ul>
</div>

<div class="related">
  <h3><?php __('Page Entity Fields');?></h3>
  <?php if (!empty($pageEntity['PageEntityField'])):?>
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
    foreach ($pageEntity['PageEntityField'] as $pageEntityField): 
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
        		array('controller' => 'page_entity_fields', 'action' => 'view', $pageEntityField['id'])); ?>
        <?php echo $this->Html->link(__('Delete', true), 
        		array('controller' => 'page_entity_fields', 'action' => 'delete', $pageEntityField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntityField['id'])); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li><?php echo $this->Html->link(__('增加字段（智能分析Not Implemented Yet）', true),
      		array('action' => 'analysisFields', $pageEntity['PageEntity']['id']),
      		array('target' => '_blank'));?></li>
      <li><?php echo $this->Html->link(__('增加字段（图形化收集）', true),
      		array('controller' => 'web_pages', 'action' => 'indexByPageEntity', $pageEntity['PageEntity']['id']),
      		array('target' => '_blank'));?></li>
      <li><?php echo $this->Html->link(__('增加字段（手动填写）', true),
      		array('controller' => 'page_entity_fields', 'action' => 'add',
      				"page_entity_id" => $pageEntity['PageEntity']['id']));?></li>
    </ul>
  </div>
</div>
