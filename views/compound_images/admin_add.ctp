<div class="compoundImages form">
<?php echo $this->Form->create('CompoundImage', array('type' => 'file')); ?>
	<fieldset>
 		<legend>
 			<?php __('Admin Add Compound Image - '); ?>
 			<?php echo $compound['Compound']['name_en']; ?>
 		</legend>
	<?php 
		echo $this->Form->hidden('Info.compound_id', array('value' => $compound['Compound']['id']));
		
		for ($i = 0; $i < 9; ++$i) {
		 echo $this->Form->input("CompoundImage.$i.url", array('type' => 'file', 'label' => "Image ".($i + 1)));
		}

		echo $this->Form->input('Info.big_image', array('options' => array('-1' => 'No big image') + range(1, 9), 'default' => '-1'));
	?>
	</fieldset>
  <?php echo $this->Form->button('提交', array('type' => 'button'));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Compound Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Change watermark', true), array('controller' => 'property_images', 'action' => 'watermark'));?></li>

	</ul>
</div>
