<?php echo $this->element('jobs/subnav') ?>

<br />
<hr />

<div class="nutchJobs index">
  <h2><?php __('Nutch Jobs');?></h2>
  <table cellpadding="0" cellspacing="0">
  <tr>
      <th>Id</th>
      <th>Round</th>
      <th>ConfId</th>
      <th>BatchId</th>
      <th>JobId</th>
      <th>Type</th>
      <th>State</th>
      <th>Fetch Count</th>
      <th>Created</th>
      <th>Crawl</th>
      <th class="actions"><?php __('Actions');?></th>
  </tr>
  <?php
  $i = 0;
  foreach ($nutchJobs as $nutchJob):
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
  ?>
  <tr<?php echo $class;?>>
    <td><?=$nutchJob['NutchJob']['id']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['round']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['confId']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['batchId']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['jobId']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['type']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['state']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['fetch_count']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['created']; ?>&nbsp;</td>
    <td><?=$this->Html->link($nutchJob['NutchJob']['crawl_id'], 
          ['controller' => 'crawls', 'action' => 'view', $nutchJob['NutchJob']['crawl_id']], ['target' => '_blank']); ?>
    <td class="actions">
      <?php echo $this->Html->link(__('View', true), 
          ['action' => 'view', $nutchJob['NutchJob']['id']], ['target' => 'layer']); ?>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
  <?php echo $this->Html->link(__('More >> ', true), array('controller' => 'nutch_jobs')); ?>
</div>

<br />
<hr />

<div class="scentJobs index">
  <h2><?php __('Scent Jobs');?></h2>
  <table cellpadding="0" cellspacing="0">
  <tr>
    <th>Id</th>
    <th>JobId</th>
    <th>Type</th>
    <th>ConfigId</th>
    <th>CrawlId</th>
    <th>State</th>
    <th>Page Entity</th>
    <th class="actions"><?php __('Actions');?></th>
  </tr>
  <?php
  $i = 0;
  foreach ($scentJobs as $scentJob):
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
  ?>
  <tr<?php echo $class;?>>
    <td><?php echo $scentJob['ScentJob']['id']; ?>&nbsp;</td>
    <td><?php echo $scentJob['ScentJob']['jobId']; ?>&nbsp;</td>
    <td><?php echo $scentJob['ScentJob']['type']; ?>&nbsp;</td>
    <td><?php echo $scentJob['ScentJob']['configId']; ?>&nbsp;</td>
    <td><?php echo $scentJob['ScentJob']['crawlId']; ?>&nbsp;</td>
    <td><?php echo $scentJob['ScentJob']['state']; ?>&nbsp;</td>
    <td>
      <?php echo $this->Html->link($scentJob['ScentJob']['page_entity_id'], 
      		['controller' => 'page_entities', 'action' => 'view', $scentJob['ScentJob']['page_entity_id']]); ?>
    </td>
    <td class="actions">
      <?php echo $this->Html->link(__('View', true), array('action' => 'view', $scentJob['ScentJob']['id'])); ?>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
  <?php echo $this->Html->link(__('More >> ', true), array('controller' => 'scent_jobs')); ?>
</div>

<br />
<hr />

<div class="sparkJobs index">
	<h2><?php __('Spark Jobs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
    <th>Id</th>
    <th>JobId</th>
    <th>Type</th>
    <th>State</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sparkJobs as $sparkJob):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sparkJob['SparkJob']['id']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['jobId']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['type']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['state']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $sparkJob['SparkJob']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sparkJob['SparkJob']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sparkJob['SparkJob']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sparkJob['SparkJob']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
  <?php echo $this->Html->link(__('More >> ', true), array('controller' => 'spark_jobs')); ?>
</div>
