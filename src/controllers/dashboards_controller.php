<?php

class DashboardsController extends AppController
{
	var $name = 'Dashboards';

	public function u_index() {
	}

	public function index()
	{
		$this->loadModel("Crawl");
		$this->Crawl->recursive = -1;
		$crawls = $this->Crawl->find('all',
			['conditions' => ['Crawl.user_id' => $this->currentUser['id']], 'limit' => 5, 'order' => 'Crawl.id DESC']);

		$this->loadModel("PageEntity");
		$this->PageEntity->recursive = -1;
		$pageEntities = $this->PageEntity->find('all',
			['conditions' => ['PageEntity.user_id' => $this->currentUser['id']],
				'limit' => 5, 'order' => 'PageEntity.id DESC']);

		$this->set(compact('crawls', 'pageEntities'));
	}

	public function bridge($target)
	{
		$this->autoRender = false;

		// Create a PSR7 request based on the current browser request.

		$request = Symfony\Component\HttpFoundation\Request::create("");

// Create a guzzle client
//		$guzzle = new GuzzleHttp\Client();

		$proxy = Proxy\Factory::create();

// Create the proxy instance
		// $proxy = new Proxy(new GuzzleAdapter($guzzle));

// Add a response filter that removes the encoding headers.
		$proxy->addResponseFilter(new Proxy\Response\Filter\RemoveEncodingFilter());

// Forward the request and get the response.
		$response = $proxy->forward($request)->to('http://www.baidu.com/');

		// echo $response->getContent();
		echo $proxy->getRequest();
		echo $response->getContent();
		die();
		
// Output response to the browser.
//		(new Zend\Diactoros\Response\SapiEmitter())->emit($response);

//		App::import("Lib", ["http_client"]);
//		$client = new \HttpClient();
//
//		$content = "No content";
//		if ($target == 'hadoop-web-ui') {
//			$content = $client->get_content(HDFS_NAME_NODE_SERVER . ":" . HDFS_NAME_NODE_PORT . "/dfshealth.html#tab-overview");
//		}
//		else if ($target == 'hbase-web-ui') {
//			$content = $client->get_content(HDFS_NAME_NODE_SERVER . ":" . HDFS_NAME_NODE_PORT . "/master-status");
//		}
//		else {
//
//		}

//		echo $content;
	}
}
