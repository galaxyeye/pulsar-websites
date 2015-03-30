<?php 

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
	public static function qpMakeLinksAbsolute($qp, $baseUrl) {
		$anchors = $qp->find('a, link');

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
}
