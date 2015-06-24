<div class="storagePageEntities form">
<?php echo $this->Form->create('StoragePageEntity', ['type' => 'get', 'action' => 'index']);?>
  <fieldset>
     <legend><?php __('Query'); ?></legend>
  <?php 
    $r = range(1, 100);
    echo $this->Form->input('startKey', ['label' => 'Start Url', 'div' => 'input text required long', 'value' => $startKey]);
    echo $this->Form->input('page', ['options' => array_combine($r, $r), 'default' => $page]);
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="storagePageEntities index">
  <h2><span><?php __('Storage Page Entities');?></span></h2>
  <table cellpadding="0" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Url</th>
    <th>Title</th>
    <th class="actions">View</th>
  </tr>
  <?php 
  $i = 0;
  foreach ($storagePageEntities as $storagePageEntity):
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
    $encodedUrl = symmetric_encode($storagePageEntity['baseUri']);
  ?>
  <tr<?php echo $class;?>>
    <td><?php echo $i ?></td>
    <td><?=$storagePageEntity['baseUri']?></td>
    <td class='pageInfo'><?=$storagePageEntity['title'] ?></td>
    <td class="actions">
        <?=$this->Html->link(__("Raw Page", true),
        		['controller' => 'storage_web_pages', 'action' => 'view', $encodedUrl],
        		['target' => '_blank']); ?>&nbsp;
        &nbsp;
      <?=$this->Html->link(__("Extracted Result", true),
          ['action' => 'view', $encodedUrl],
          ['target' => '_blank']); ?>&nbsp;
    </td>
  </tr>
  <?php endforeach; ?>
  </table>
</div>
