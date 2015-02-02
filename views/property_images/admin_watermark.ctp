<div>
	<h2>当前水印</h2>

	原始尺寸：
	<div style='width:300px; padding:25px 0; border:1px dotted #ccc; text-align:center;'>
		<img src='/img/uploads/watermark.png' style='border:1px solid #ccc' />
	</div>

	<br />

	放大尺寸：
	<div style='width:300px; padding:25px 0; border:1px dotted #ccc; text-align:center;'>
		<img src='/img/uploads/watermark.png' width='250'  style='border:1px solid #ccc' />
	</div>
</div>

<br />

<div class="propertyImages form">
<?php echo $this->Form->create('PropertyImage', array('type' => 'file', 'action' => 'watermark'));?>
	<fieldset>
 		<legend>更换水印</legend>
	<?php echo $this->Form->input("url", array('type' => 'file', 'label' => "watermark")); ?>
	</fieldset>
  <?php echo $this->Form->end('提交');?>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Property Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
	</ul>
</div>
