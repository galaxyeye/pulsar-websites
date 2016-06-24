<div class="storageWebPages form">
<?php echo $this->Form->create('StorageWebPage', ['type' => 'get', 'action' => 'index']);?>
  <fieldset>
     <legend><?php __('Query Fetched Web Pages'); ?></legend>
  <?php 
    $r = range(1, 100);
    echo $this->Form->input('startKey', ['label' => 'Start Url', 'div' => 'input text required long', 'value' => $startKey]);
    echo $this->Form->input('page', ['options' => array_combine($r, $r), 'default' => $page]);
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="storageWebPages index">
  <h2>
    <span><?php __('Fetched Web Page Links');?></span>
  </h2>
  <table cellpadding="0" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Title</th>
    <th>Base Url</th>
  </tr>
  <?php 
  $i = 0;
  foreach ($storageWebPages as $storageWebPage) :
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }

    if (!isset($storageWebPage['title'])) {
    	$storageWebPage['title'] = "";
    }

    $encodedUrl = symmetric_encode($storageWebPage['baseUrl']);
  ?>
  <tr<?php echo $class;?>>
    <td><?php echo $i ?></td>
    <td class='pageInfo'>
      <?=$storageWebPage['title']; ?>&nbsp;
    </td>
    <td class='pageInfo'>
      <?=$this->Html->link($storageWebPage['baseUrl'], ['action' => 'view', $encodedUrl], ['target' => '_blank']); ?>&nbsp;
    </td>
  </tr>
  <?php endforeach; ?>
  </table>
</div>
