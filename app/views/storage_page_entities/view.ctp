<div class="storagePageEntities view">
  <h2><?php  __('Storage Web Entity');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $pageEntity['PageEntity']['url']; ?>
        &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $pageEntity['PageEntity']['title']; ?>
      &nbsp;
    </dd>
  </dl>
</div>
<!-- info-box -->

<div class='storagePageEntities view'>
	<h2>Mining Result</h2>
  <div><?php echo $pageEntity['PageEntity']['content']; ?></div>
</div>
