<?php 
	$html->script('fckeditor');

	$html->script('kissy_editor/aio', false);
	$html->script('kissy_editor/editor', false);

	// image uploading module requires the two libaries
	$html->script('kissy_editor/connection-min.js');

	$this->viewVars['css_for_layout'] = $html->css('kissy_editor/themes/default/editor.css');
?>

<div id="demo-page" style="margin-left:30px;">
	<br/>
	<textarea name="code" id="reply" rows="50" cols="152" style="width: 840px; height: 295px">
    </textarea>
    <br/>
</div>

<div id="msg"></div>

<div style="margin-left:30px;">=====================我是华丽的分割线==========================</div>

<div id="fck-demo" style="margin-left:30px; width:800px">
	<?php echo $fck->fckeditor(array('Prize', 'description'), $html->base, '这里就是一些默认的文字啦');?>
</div>

<?php 
	$config = array(
		'base' => $this->webroot,
		'toolbar' => array(
            "source",
            "",
            "fontName", "fontSize", "bold", "italic", "underline", "strikeThrough", "foreColor", "backColor",
            "",
            "link", "smiley", "image",
            "",
            "insertOrderedList", "insertUnorderedList", "outdent", "indent", "justifyLeft", "justifyCenter", "justifyRight"
		),

		'pluginsConfig' => array(
            'image' => array(
                'tabs' => array("link"),
                'upload' => array(
                    'actionUrl' => (($this->webroot == '/') ? '' : $this->webroot)."/common/kissyPictureUpload"
                )
            )
		)
	);

	$config = json_encode($config);
	$html->scriptBlock("KISSY.Editor('reply', $config)", array('inline' => false));
?>
