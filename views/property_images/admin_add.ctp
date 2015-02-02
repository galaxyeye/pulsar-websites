<div class="propertyImages form">
<?php echo $this->Form->create('PropertyImage', array('type' => 'file'));?>
	<fieldset>
 		<legend>
 			<?php __('Admin Add Property Image - '); ?>
 			<?php echo $property['Property']['pid']; ?>
 		</legend>
	<?php 
		echo $this->Form->hidden('Info.property_id', array('value' => $property['Property']['id']));

		for ($i = 0; $i < 9; ++$i) {
		 echo $this->Form->input("PropertyImage.$i.url", array('type' => 'file', 'label' => "Image ".($i + 1)));
		}

		echo $this->Form->input('Info.big_image', array('options' => array('-1' => 'No big image') + range(1, 9), 'default' => '-1'));
	?>
	</fieldset>
  <?php echo $this->Form->button('提交', array('type' => 'button'));?>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Property Images', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Change watermark', true), array('action' => 'watermark'));?></li>
	</ul>
</div>
