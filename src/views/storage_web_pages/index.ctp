<?php echo $this->element('crawls/subnav') ?>

<div class="storageWebPages form">
<?php echo $this->Form->create('StorageWebPage', ['type' => 'get', 'action' => 'index']);?>
  <fieldset>
     <legend><?php __('Query Fetched Web Pages'); ?></legend>
  <?php 
    $r = range(1, 100);
    echo $this->Form->input('startKey', ['label' => 'Start Url', 'div' => 'input text required long', 'value' => $startKey]);
    echo $this->Form->input('page', ['options' => array_combine($r, $r), 'default' => $page]);
    echo $this->Form->hidden('page_entity_id', ['value' => $page_entity_id]);
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<?php if ($localStorageMode) : ?>
  <p class="message yellow">We are under local storage mode</p>
<?php endif; ?>

<div class="storageWebPages index">
  <h2><span><?php __('Fetched Web Page Links');?></span></h2>
  <p class="message">Any links below leads you to web mining rules analysis</p>

  <table cellpadding="0" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Base Url</th>
    <th class="actions"><?php __('Actions');?></th>
  </tr>
  <?php 
  $i = 0;
  foreach ($storageWebPages as $storageWebPage) :
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
    $encodedUrl = symmetric_encode($storageWebPage['baseUrl']);
  ?>
  <tr<?php echo $class;?>>
    <td><?php echo $i ?></td>
    <td class='pageInfo'>
      <?=$this->Html->link($storageWebPage['baseUrl'], ['action' => 'view', $encodedUrl], ['target' => '_blank']); ?>&nbsp;
    </td>
		<td class="actions">
		  <?php if(!empty($page_entity_id)) : ?>
      <?=$this->Html->link(__("Auto Analysis", true),
          ['action' => 'analysis', $encodedUrl, 'page_entity_id' => $page_entity_id],
          ['target' => '_blank']); ?>&nbsp;
      <?=$this->Html->link(__("Manual Analysis", true),
          ['action' => 'view', $encodedUrl, 'page_entity_id' => $page_entity_id],
          ['target' => '_blank']); ?>&nbsp;
		  <?php endif; ?>
		</td>
  </tr>
  <?php endforeach; ?>
  </table>
</div>

<script type="text/javascript">
<!--
  var page_entity_id = <?=$page_entity_id ?>;
//-->
</script>
