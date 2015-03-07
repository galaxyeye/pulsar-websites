<?php 

App::import('Lib', array('qp'));

class WebPagesController extends AppController {

	var $name = 'WebPages';

	function search() {
		if (empty($this->data)) {
			$this->loadModel('Crawl');
			// $this->Crawl->find('list', array('fields' => array('batchId')));
		}

		if (!empty($this->data)) {
			$nutchClient = new NutchClient();

			$startKey = $this->data['WebPage']['startKey'];
			$endKey = $this->data['WebPage']['endKey'];
			if (empty($startKey)) $startKey = null;
			if (empty($endKey)) $endKey = null;

			// $dbFilter = new DbFilter(null,$startKey, $endKey, array('parseStatus', 'content'));
			$dbFilter = new DbFilter(null,$startKey, $endKey);

			pr($dbFilter->__toString());

			$result = $nutchClient->query($dbFilter);
			$this->set('webPages', json_decode($result, true, 10));
		}
	}

	function searchByUrl($url = null) {
		if (!$url && empty($this->data)) {
			return;
		}

		if ($url) {
			$startKey = simple_decode($url);
			$endKey = null;
		}

		if (!empty($this->data)) {
			$startKey = $this->data['WebPage']['startKey'];
			$endKey = $this->data['WebPage']['endKey'];
		}

		if (empty($startKey)) $startKey = null;
		if (empty($endKey)) $endKey = null;

		$nutchClient = new NutchClient();
		$dbFilter = new DbFilter(null, $startKey, $endKey);
		$webPages = $nutchClient->query($dbFilter);
		$webPages = json_decode($webPages, true, 10);

		$this->set(compact('webPages', 'dbFilter'));
	}

	function index() {
		$webPages = array(
				array('WebPage' => array(
						'url' => "http://www.hahaertong.com/huodong-shanghai/",
						'title' => '东方童画3月萌宝生日会，邀您一起来参与！ '
					)
				),
				array('WebPage' => array(
						'url' => "http://www.hahaertong.com/huodong-beijing/",
						'title' => 'Duang!宝贝闹元宵，欢乐送大礼！ '
					)
				)
		);

		$this->set(compact('webPages'));
	}

	function view($url) {
		$this->layout = 'empty';

		$options = array();
		if (isset($this->params['named']['options'])) {
			$options = explode("+", $this->params['named']['options']);
		}

		$startKey = simple_decode($url);
		$endKey = null;

		$nutchClient = new NutchClient();
		$dbFilter = new DbFilter(null, $startKey, $endKey);
		$webPages = $nutchClient->query($dbFilter);
		$webPages = json_decode($webPages, true, 10);

		$webPage = array(
				'WebPage' => array(
						'url' => $startKey,
						'content' => ''
				)
		);

		if (!empty($webPages['values'])) {
			App::import('Vendor', 'PHPHtmlParser/Dom');
			$webPage['WebPage'] = $webPages['values'][0];

			$content = $webPage['WebPage']['content'];

			$dom = htmlqp($content, null, array('convert_to_encoding' => 'utf-8'));
			$dom->find('title')->remove();
			$dom->find('base')->remove();
			$dom->find('script')->remove();
			$dom->find('style')->remove();
			$dom->find('meta')->remove();
			$dom->find('img')->html("")->removeAttr("src");

			if (in_array('simpleCss', $options)) {
				$dom->find('link')->remove();
			}

// 			foreach ($dom->find('a') as &$l) {
// 				$l->src();
// 			}

			$content = $dom->html();
			$content = str_replace("html", "div", $content);
			$content = str_replace("body", "div", $content);
			$content = str_replace("<!DOCTYPE", "<!--", $content);
			$content = str_replace(".dtd\">", "-->", $content);
			$webPage['WebPage']['content'] = $content;
		}

		$this->set(compact('webPage', 'options'));
	}

	function download($url) {
		$this->layout = 'empty';

		$url = simple_decode($url);
		$content = file_get_contents($url);

		App::import('Vendor', 'PHPHtmlParser/Dom');
		$dom = htmlqp($content, null, array('convert_to_encoding' => 'utf-8'));
		$title = $dom->find('title')->text();

		$dom->find('title')->remove();
		$dom->find('script')->remove();
		$dom->find('style')->remove();
		$dom->find('meta')->remove();
		$dom->find('img')->html("")->removeAttr("src");

		$content = $dom->html();
		$content = str_replace("html", "div", $content);
		$content = str_replace("body", "div", $content);

		$webPage = array(
				'WebPage' => array(
						'url' => $url,
						'title' => $title,
						'content' => $content
				)
		);

		$this->set(compact('webPage'));
	}

	private function __analysis($dom) {
		// 		pr($dom);
		// 		die();
	
		$this->__walk($dom);
	}
	
	private function __walk($dom) {
		$node = $dom->top();

		$this->__analysisNode($node);

		$this->__walkChildren($node);
	}

	private function __walkChildren($dom) {
		foreach($dom->children() as $child) {
			$this->__analysisNode($child);

			$this->__walkChildren($child);
		}
	}

	private function __analysisNode($node) {
		if (in_array($node->tag(), $this->keyTags)) {
			// do something
			pr($node->tag().$node->text());
		}
	}

	private function __trimAllTags($page) {
	}

	private function __segmentWords($page) {
	}

	private function __parseMeta($dom) {
		$meta = array('title', '');
	
		$title = $dom->find('title');
		$metaKeywords = $dom->find('meta');
		$metaDescription = $dom->find('meta');
	}

	function __analysisHeaders($dom) {
		$headerTags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

		foreach ($headerTags as $headerTag) {
			foreach ($dom->find($headerTag) as $h) {
				$headerTags[$headerTag] = $h->html();
			}
		}

		return $headerTags;
	}

	function __analysisSummary($dom) {
	
	}

	function __analysisTags($dom) {

	}
}
