<?php 
  global $allExtractors, $jobChangeMap, $crawlStatusChangeMap, $jobType2Status, $jsEvents,
	  $urlFilterTemplate, $textFilterTemplate, $parseBlockTemplate;

  $allExtractors = array(
  		'TextExtractor' => 'TextExtractor',
  		'GalleryExtractor' => 'GalleryExtractor',
  		'LinkExtractor' => 'LinkExtractor',
  		'ImageExtractor' => 'ImageExtractor',
  		'LinksExtractor' => 'LinksExtractor',
  		'RawExtractor' => 'RawExtractor',
  		'ImagesExtractor' => 'ImagesExtractor'
  );

  $jobChangeMap = array(
  		"NONE" => "INJECT",
  		"INJECT" => "GENERATE",
  		"GENERATE" => "FETCH",
  		"FETCH" => "PARSE",
  		"PARSE" => "UPDATEDB",
  		"UPDATEDB" => "GENERATE"
  );

  $jobStateChangeMap = array(
  		"NONE" => "INJECT",
  		"INJECT" => "GENERATE",
  		"GENERATE" => "FETCH",
  		"FETCH" => "PARSE",
  		"PARSE" => "UPDATEDB",
  		"UPDATEDB" => "GENERATE"
  );

  $jsEvents = array(
  		'focus',
  		'blur',
  		'click',
  		'dblclick',
  		'keydown',
  		'keypress',
  		'keyup',
  		'mousedown',
  		'mousemove',
  		'mouseout',
  		'mouseover',
  		'mouseup'
  );

  $urlFilterTemplate =
<<<END
+http://item.example.com/.+.html
-http://item.example.com/[1-2000000].html
END;

  $textFilterTemplate =
<<<END
{
    containsAll:"Example,手机,平板,超级本",
    containsAny:"Example,数码相机,超级本,小米手机",
    notContainsAll:"Example,电脑,一体机,相机",
    notContainsAny:"Example,雅虎,谷歌,华为"
}
END;

  $parseBlockTemplate =
<<<END
{
    "allow": ["#exampleId .content > div", "#paginate"],
    "disallow": ["#exampleId #comment", ".shopDetail"]
}
END;
