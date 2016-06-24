<?php 
$location = isset($this->params['named']['location']) ? $this->params['named']['location'] : '上海';

$basedata = array();

foreach ($geos as $geo) {
	$d = array(
		'title' => $geo['Geo']['title'], 
		'content' => $geo['Order']['address'], 
		'point' => $geo['Geo']['point'],
		'icon' =>'{w:23,h:25,l:115,t:46,x:1,lb:10}'
	);

	$basedata[] = $d;
}

$basedata = json_encode($basedata);

$code = <<<JS
    var BASEDATA = $basedata;

    // 创建和初始化地图函数：
    function initMap() {
        window.map = new BMap.Map("bmap");

        map.centerAndZoom('上海市', 12);

        map.enableScrollWheelZoom();
		    map.addControl(new BMap.NavigationControl());

        addMarker(BASEDATA);//向地图中添加marker
    }

    // 创建marker
    window.addMarker = function (data){
        map.clearOverlays();
        for(var i = 0; i < data.length; i++){
            var json = data[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
            var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
            var iw = createInfoWindow(i);
            var label = new BMap.Label(json.content, {"offset":new BMap.Size(6, -35)});
            marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });

	        (function(){
				  	var _json = json;
				    var _iw = createInfoWindow(_json);
				    var _marker = marker;

				    _marker.addEventListener("click",function(){
				        this.openInfoWindow(_iw);
				    });
				    label.addEventListener("click",function(){
				        _marker.openInfoWindow(_iw);
				    });
				   })(); // closer
        } // end for
    } // end addMarker

    //创建InfoWindow
    function createInfoWindow(json){
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }

    //创建一个Icon
    function createIcon(json) {
        var icon = new BMap.Icon(
        	"http://openapi.baidu.com/map/images/us_mk_icon.png", 
        	new BMap.Size(23, 25), 
        	{
        		anchor: new BMap.Size(10, 25)
        	}
        );

        return icon;
    }

		$('#goto').click(function() {
			$('#results').html('');
			var loc = $('#location').val();
			var local = new BMap.LocalSearch(map, {
			  renderOptions:{map: map, panel: "results"}
			});
			local.search(loc);
		});

    initMap();//创建和初始化地图
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
