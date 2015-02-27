<?php 
$location = isset($this->params['named']['location']) ? $this->params['named']['location'] : '上海';
$code = <<<JS
	window.map = new BMap.Map("bmap");          			// 创建地图实例

	map.enableScrollWheelZoom();  								// 开启鼠标滚轮缩放  
	map.enableKeyboard();         								// 开启键盘控制  
	map.enableContinuousZoom();   								// 开启连续缩放效果  
	map.enableInertialDragging(); 								// 开启惯性拖拽效果  	
	var point = new BMap.Point(116.404, 39.915);  // 创建点坐标
	map.centerAndZoom('上海', 15);                 // 初始化地图，设置中心点坐标和地图级别

	var loc = $('#location').val();
	var first = true;

	$('#goto').click(function() {
		if (!first) {
			$('#results').html('');
			var loc = $('#location').val();
			var local = new BMap.LocalSearch(map, {
			  renderOptions:{map: map, panel: "results"}
			});
			local.search(loc);
		}
	});

	window.setTimeout(function() {
	  var local = new BMap.LocalSearch(map, {
		  renderOptions:{map: map, panel: "results"}
		});
		local.search(loc);
		first = false;
	}, 1500);
JS;
?>

<style>
<!-- 
#previewBMap .frame2 .column1 { background:none; border:none; float: left; width: 800px; clear:none; padding:3px;}
#previewBMap .frame2 .column2 { float: left; clear:none; padding:3px; width: 320px; -moz-border-radius:0; margin-left:10px; margin-top:23px; background:none; border:none; }
#previewBMap .actions .col1 { width:80%;}
#previewBMap .actions .col1 label { width:3em;}
#previewBMap .actions .col1 input { width:13em;}
#previewBMap .actions .col2 { width:12%;}
-->
</style>

<div id='previewBMap'>
	<div class='map frame2 clearfix'>
		<div class='column1' id="bmap" style="width:800px; height:600px;"></div>
		<div class='column2'>
			<div class='fieldset2 actions clearfix'>
				<?php echo $form->input('location', array('value' => $location, 'label' => '位置', 'div' => 'col1 input text')) ?>
				<div class='col2'><a id='goto'>转到</a></div>
			</div>
			<div id="results" style="font-size:13px;margin-top:10px;"></div>
		</div>
	</div>
</div>

<?php if ($this->layout == 'preview') :  ?>
<script type="text/javascript">
<?php echo $code; ?>
</script>
<?php else : ?>
<?php echo $this->Html->scriptBlock($code, array('inline' => false)); ?>
<?php endif; ?>
