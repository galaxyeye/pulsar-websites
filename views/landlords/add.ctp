<?php 
   if (isset($old_filter['property_type']) && $old_filter['property_type'] != 'null') {
     $title_for_layout = str_replace('{{property-type}}', $old_filter['property_type'], $title_for_layout);
   }
   else {
     $title_for_layout = str_replace('{{property-type}}', 'Apartments', $title_for_layout);
   }

   $this->set('title_for_layout', $title_for_layout);

?>

<div class="landlords form">
<h2>Landlord - For Rent&nbsp;&nbsp;&nbsp;业主委托 - 出租房源登记</h2>
<p>
	Thanks for choosing SINORELO. To accelerate your rental transaction, we'd like you to fill in the questionnaire below and send the property pictures to <span class='blue'>property@sinorelo.com</span>. 
	You could also call our hotline: <span class='orange1'>+86 21 5075 8626</span> for registration or any questions.<br />
感谢您选择SINORELO，为了帮您尽早实现出租收益，请如实填写登记表格并将房屋照片发送至<span class='blue'>property@sinorelo.com</span>，当然您也可以致电房源热线<span class='orange1'>+86 21 5075 8626</span>登记您的房源信息。
</p>

<?php echo $this->Form->create('Landlord');?>
	<h4>Personal Profile  业主信息</h4>
	<fieldset class='cl'>
  	<ul class='frame-1-1-l'>
  	<?php 
  		echo $this->Form->input_item('gender', array('options' => array('Mr.' => 'Mr. / 先生', 'Ms. / 女士'), 'label' => 'Gender / 称呼'));
  	  echo $this->Form->input_item('email', array('label' => 'Email / 邮件'));
    ?>
  	</ul>
  	<ul class='frame-1-1-r'>
    <?php 
  		echo $this->Form->input_item('full_name', array('label' => 'Full Name / 姓名'));
      echo $this->Form->input_item('cell_phone', array('label' => 'Cell Phone / 手机'));
    ?>
  	</ul>
	</fieldset>

  <h4>Property Information 房源信息</h4>
  <fieldset class='cl'>
    <ul class='frame-1-1-l'>
    <?php
    	echo $this->Form->input_item('compound_name', array('label' => 'Compound Name / 小区名称'));
  		echo $this->Form->input_item('property_address', array('label' => 'Property Address / 详细地址'));
  		echo $this->Form->input_item('unit_size', array('label' => 'Unit Size(sqm) / 建筑面积'));
  		echo $this->Form->input_item('bedrooms', array('label' => 'Number of Bedrooms / 卧室数量'));
  		echo $this->Form->input_item('livingrooms', array('label' => 'Number of Livingrooms / 厅数量'));
  		echo $this->Form->input_item('bathrooms', array('label' => 'Number of Bathrooms / 卫生间数量'));
  		echo $this->Form->input_item('furnishings', array('label' => 'Furnishings / 装修情况', 'options' => array('Fully Furnished' => 'Fully Furnished / 精装全配', 'Partly Furnished' => 'Partly Furnished / 部分家具', 'Unfurnished' => 'Unfurnished / 无家具')));
  	?>
  	</ul>
    <ul class='frame-1-1-r'>
    <?php
  		echo $this->Form->input_item('rental', array('label' => 'Rental(RMB/Month) / 期望月租金'));
  		echo $this->Form->input_item('comments', array('label' => 'Please note any other comments / 其他备注或说明'));
  	?>
  	</ul>
	</fieldset>

   <?php echo $this->Form->end('Submit / 提交');?>
</div>

<br />
<br />
