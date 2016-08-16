<?php echo $this->element('jobs/subnav') ?>

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
    <td><?=$nutchJob['NutchJob']['count']; ?>&nbsp;</td>
    <td><?=$nutchJob['NutchJob']['created']; ?>&nbsp;</td>
    <td><?=$this->Html->link($nutchJob['NutchJob']['crawl_id'], 
          ['controller' => 'crawls', 'action' => 'view', $nutchJob['NutchJob']['crawl_id']], ['target' => '_blank']); ?>
    <td class="actions">
      <?php echo $this->Html->link(__('View', true), 
          ['controller' => 'nutch_jobs', 'action' => 'view', $nutchJob['NutchJob']['id']], ['target' => 'layer']); ?>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
  <?php echo $this->Html->link(__('More >> ', true), ['controller' => 'nutch_jobs']); ?>
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
      <?php echo $this->Html->link(__('View', true),
      		['controller' => 'scent_jobs', 'action' => 'view', $scentJob['ScentJob']['id']]); ?>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
  <?php echo $this->Html->link(__('More >> ', true), ['controller' => 'scent_jobs']); ?>
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
			<?php echo $this->Html->link(__('View', true),
					['controller' => 'spark_jobs', 'action' => 'view', $sparkJob['SparkJob']['id']]); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
  <?php echo $this->Html->link(__('More >> ', true), ['controller' => 'spark_jobs']); ?>
</div>
