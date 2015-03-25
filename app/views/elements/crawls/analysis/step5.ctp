
<!---------------------------------------------------------->
<!-- 第五步： 查看结果 -->
<!---------------------------------------------------------->
<!-- Page Entity -->
<div class="pageEntities analysis step-5 view">
	<h2><?php  __('Page Entity');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
      <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $pageEntity['PageEntity']['id']; ?></span>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $pageEntity['PageEntity']['name']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Url Filter'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $pageEntity['PageEntity']['url_filter']; ?></pre>
			&nbsp;
		</dd>
	</dl>
</div>

<!-- Scent Job -->
<?php 
    if(!empty($pageEntity['ScentJob'])) : 
      $scentJob = $pageEntity['ScentJob'][0];
  ?>
<div class="scentJobs related">
	<h3>挖掘结果</h3>
	<ol id="sqlList" class='decimal'>
	</ol>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Download Sql File', true),
				['controller' => 'scent_jobs', 'action' => 'downloadExtractResult', $scentJob['id']],
				['class' => 'download hidden']); ?> </li>
	</ul>
</div>

<div class="scentJobs view">
	<h2><?php  __('Scent Job');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
      <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $scentJob['id']; ?></span> &nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('JobId'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $scentJob['jobId']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $scentJob['type']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('ConfigId'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $scentJob['configId']; ?>
        &nbsp;
      </dd>
	</dl>
</div>
<?php endif; ?>
<!-- End not empty ScentJob -->

<div class="scentJobs view">
	<h3><?php  __('数据挖掘服务器消息');?></h3>

	<div id="scentJobInfoRaw">
		<pre></pre>
	</div>
</div>

<script type="text/x-jsrender" id="sqlListTemplate">
  <li>{{:#data}}</li>
</script>
