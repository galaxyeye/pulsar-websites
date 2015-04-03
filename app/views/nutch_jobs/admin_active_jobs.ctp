<div class="nutchJobs index">
  <h2><?php __('Active Nutch Jobs');?></h2>
  <table cellpadding="0" cellspacing="0">
  <tr>
      <th>Id</th>
      <th>Type</th>
      <th>ConfId</th>
      <th>State</th>
      <th>Msg</th>
      <th>Args</th>
      <th>Result</th>
  </tr>
  <?php 
  $i = 0;
  foreach ($nutchJobs as $nutchJob):
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
    $args = json_encode($nutchJob['args'], JSON_PRETTY_PRINT);
    $result = json_encode($nutchJob['result'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (strlen($result) > 3000) {
    	$result = "Ignored Too Long Result";
    }
    $msg = $nutchJob['msg'];
    if (striContains($msg, "error")) {
    	$msg = "Error";
    }
  ?>
  <tr<?php echo $class ?>>
    <td class='model-id'><?=$nutchJob['id'] ?></td>
    <td><?=$nutchJob['type'] ?>&nbsp;</td>
    <td><?=$nutchJob['confId'] ?>&nbsp;</td>
    <td><?=$nutchJob['state'] ?>&nbsp;</td>
    <td>
    	<div class='layer'><?=$msg ?>
    	  <div class='data hidden'><?=$nutchJob['msg'] ?></div>
    	</div>
    </td>
    <td>
    	<div class='layer'><a href="javascript:;">View</a>
      	<div class='data hidden'><pre><?=$args ?></pre></div>
    	</div>
    </td>
    <td>
    	<div  class='layer'>
			<?php echo $this->Html->link(__('View', true), 
					['action' => 'activeJob', $nutchJob['id']], ['target' => '_blank']); ?>
    	  <div class='data hidden'><pre><?=$result ?></pre></div>
    	</div>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
</div>

<div class="actions">
  <ul>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
  </ul>
</div>
