<?php 

App::import('Vendor', 'qp');

class HtmlUtils {

  public static function getAbsoluteUrl($baseUrl, $href) {
    if (startsWith($href, "javascript")) {
    return;
    }

    if (!startsWith($href, 'http')) {
    $path = '/' . ltrim($href, '/');
    $href = http_build_url($url, array ('path' => $path));
    } // if

    return $href;
  }

  /**
   * standard DOMDocument
   * */
  public static function makeLinksAbsolute(&$dom, $baseUrl) {
    $anchors = $dom->getElementsByTagName('a');

    foreach($anchors as &$element ) {
    $href = $element->getAttribute('href');

    if (!startsWith($href, 'http')) {
      $path = '/' . ltrim($href, '/');
      $href = http_build_url($baseUrl, array ('path' => $path));
    } // if

    $element->setAttribute('href', $href);
    } // foreach
  } // makeLinksAbsolute

  /**
   * Query Path
   * */
  public static function qpMakeLinksAbsolute($dom, $baseUrl) {
    $anchors = $dom->find('a, link');

    $anchors->each(function($index, $item) use($baseUrl) {
    $href = $item->getAttribute('href');
    if (startsWith($href, "javascript")) {
      return;
    }

    if (!startsWith($href, 'http')) {
      $path = '/' . ltrim($href, '/');
      $href = http_build_url($baseUrl, array ('path' => $path));
    } // if

    $item->setAttribute('href', $href);
    });

  } // qpMakeLinksAbsolute

  /**
   * Query Path
   * */
  public static function qpRemoveAllInlineStyle($dom) {
    $dom->each(function($index, $item) {
    $item->removeAttribute('style');
    });
  } // qpRemoveAllInlineStyle

  /**
   * Strip HTML
   * */
  public static function stripHTML($html, $baseUri, $options) {
    if (empty($html)) {
      return null;
    }

    $MIN_CONTENT_LENGTH = 100;
    if (strlen($html) < $MIN_CONTENT_LENGTH) {
      return null;
    }

    $dom = htmlqp($html, null, ['convert_to_encoding' => 'utf-8']);

    HtmlUtils::qpMakeLinksAbsolute($dom, $baseUri);
    // HtmlUtils::qpRemoveAllInlineStyle($dom);

    $title = $dom->find('title')->text();
    if (in_array('raw', $options)) {
    	return array('title' => $title, 'content' => $html);
    }

    $dom->find('*')->each(function($index, $item) {
    	$item->removeAttribute('style');
    });

    $removeTags = [
    		'title', 'base', 'script', 'meta', 'iframe',
    		'link[rel=icon]', 'link[rel="shortcut icon"]'
    ];

    if (isset($options['removeTags'])) {
    	$removeTags = $options['removeTags'];
    }

    foreach ($removeTags as $removal) {
      $dom->find($removal)->remove();
    }

    if (in_array('simpleCss', $options)) {
      foreach (['style', 'link', 'head'] as $removal) {
        $dom->find($removal)->remove();
      }
    }

    // Add qiwur specified information
    $dom->find('html')->attr('id', 'qiwurHtml');
    $dom->find('body')->attr('id', 'qiwurBody');
    $dom->find('img')->html("")->removeAttr("src");

    // A fix for older QiwurScrapingMetaInformation holder protocol
    // we can not make this information at the first div, instead of which
    // we move the information to a created input element at to bottom of 
    // body element
    $dom->find('#QiwurScrapingMetaInformation')->removeAttr('id');

    $html = $dom->html();

    // Strip to show the page inside our own layout
    // TODO : Can we do these replace using $dom ?
    $html = preg_replace("/<html|<body|<head/", "<div", $html);
    $html = preg_replace("/DOCTYPE|dtd|xml/i", "", $html);

    $html = preg_replace("/#QiwurScrapingMetaInformation &gt;/", "body &gt;", $html);
    $html = preg_replace("/#qiwurBody &gt;/", "body &gt;", $html);

    return array('title' => $title, 'content' => $html);
  }
}
