<?php 
class WebpagesController extends AppController {

	var $name = 'Webpages';

	var $keyTags = array('title', 'meta', 
			'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
	);

	function admin_index() {
		$this->Webpage->recursive = 0;
		$this->set('webpages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid webpage', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('webpage', $this->Webpage->read(null, $id));
	}

	function analysis($file = null, $workshop = WORKSHOP) {
		if ($page == null) {
			echo 'no file choosed';

			return;
		}

		$path = WORKSHOP;
		$file = $path . DS . $page;

		$page = fread(fopen($f, 'r'), filesize($page));
		$this->__analysis($page);
		fclose($page);
	}

	function admin_add() {
		// pr($this->data);

		try {
			if (!empty($this->data)) {
				$remotePage = $this->data['Webpage']['url'];
				$localPage = $this->data['Webpage']['file'];
	
				if (!empty($remotePage)) {
					$dom = qp($remotePage);

					$this->__analysis($dom);
				}
				else if (is_uploaded_file($localPage['tmp_name'])) {
					$dest = '/tmp/'.date("ymdHis").'.'.end(explode(".", low($localPage['name'])));

					copy($localPage['tmp_name'], $dest);

					$dom = qp($dest);
					$this->__analysis($dom);
	
					unlink($localPage['tmp_name']);
					unlink($dest);
				}
				else {
					echo 'no page';
				}
			} // end empty
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid webpage', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if ($this->Webpage->save($this->data)) {
				$this->Session->setFlash(__('The webpage has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The webpage could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->Webpage->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for webpage', true));
			$this->redirect(array('action'=>'index'));
		}

		if ($this->Webpage->delete($id)) {
			$this->Session->setFlash(__('Webpage deleted', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->Session->setFlash(__('Webpage was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function __analysis($dom) {
// 		pr($dom);
// 		die();

		$this->__walk($dom);
	}

	function __walk($dom) {
		$node = $dom->top();

		$this->__analysisNode($node);

		$this->__walkChildren($node);
	}

	function __walkChildren($dom) {
		foreach($dom->children() as $child) {
			$this->__analysisNode($child);

			$this->__walkChildren($child);
		}
	}

	function __analysisNode($node) {
		if (in_array($node->tag(), $this->keyTags)) {
			// do something
			pr($node->tag().$node->text());
		}
	}

	function __trimAllTags($page) {
	}

	function __segmentWords($page) {
	}

	function __parseMeta($dom) {
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
