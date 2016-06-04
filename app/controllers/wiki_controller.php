<?php 
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * Logoloto(tm) :  The best CPA advertisement network (http://www.logoloto.com)
 * Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 *
 * @filesource
 * @copyright     Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 */
?>

<?php 

App::import('Vendor', 'graph');

class WikiController extends AppController {

	private $format = 'json';

	private $apiHub = "http://people.qiwur.com/w/api.php";

//	private $_graph;

    public function beforeFilter() {
      parent::beforeFilter();
      $this->Auth->allowedActions = array('*');

      // $this->_graph = new Graph(2);
    }

    public function index() {
    	$graph = new Graph(2);
    	$graph->addEdge($source, $destination);
    	$vertices = $graph->getVertices();

    	$r = array_map(function ($vertex) {
    		return array($vertex);
    	}, $vertices);

    	echo pr($r);
    }

    public function view() {
    }

    public function query($q) {
    	$this->autoRender = false;

    	$res = $this->query_wiki($q);
    	return $res;
    }

    public function browseBySubject($subject = null) {
    	$this->autoRender = false;

    	if ($subject == null) {
    		$subject = 'Shu-Jen Han';
    	}

    	$q = [
   			'action' => 'browsebysubject',
   			'subject' => $subject,
   			'format' => $this->format
    	];

    	$res = $this->query_wiki($q);

    	return $res;
    }

    public function browsebyproperty() {
    	
    }

    public function queryByTitle($title = null) {
    	$this->autoRender = false;

    	if ($title == null) $title = 'Shu-Jen Han';

    	$q = [
   			'action' => 'query',
   			'titles' => 'Shu-Jen Han',
   			'format' => $this->format
    	];

    	$res = $this->query_wiki($q);

    	return $res;
    }

    public function queryProperty($title) {
    	$this->autoRender = false;
    
    	$q = [
   			'action' => 'query',
   			'titles' => '属性:Has Address',
   			'format' => $this->format
    	];

    	$res = $this->query_wiki($q);

    	return $res;
    }

    public function ask() {
    	$this->autoRender = false;

    	$q = [
   			'action' => 'ask',
   			'query' => '[[category:人物]]',
   			'format' => $this->format
    	];

    	$res = $this->query_wiki($q);

    	return $res;
    }

    public function graph() {
    	$subject = "";

    	if (isset($this->params['url']['subject'])) {
    		$subject = $this->params['url']['subject'];
    	}

    	// $p = browseBySubject();
    	$this->set('subject', $subject);
    }

    private function query_wiki($q) {
    	if (is_array($q)) {
    		$q = http_build_query($q);
    	}

    	App::import('Lib', array('http_client'));

    	$httpClient = new \HttpClient();
    	$res = $httpClient->get_content($this->apiHub.'?'.$q);

    	return $res;
    }

    public function getGraph() {
    	$this->autoRender = false;
    	header('Access-Control-Allow-Origin: *');

    	$g = $this->_generateData();

//     	$g = $this->_convertWikiToGraph('Shu-Jen Han');

    	// inference nodes in relation
    	foreach ($g['links'] as $link) {
    		if (in_array($link['name'], ['同事', '党派竞争对手', '共同作者'])) {
    			array_push($g['nodes'], ['category' => '人物', 'name' => $link['target']]);
    		}
    		else if (in_array($link['name'], ['毕业于', '就职于'])) {
    			array_push($g['nodes'], ['category' => '机构', 'name' => $link['target']]);
    		}
    	}

    	$subject = null;
    	if (isset($this->params['url']['subject'])) {
    		$subject = $this->params['url']['subject'];
    	}

    	$g = $this->_searchGraph($subject, $g);

    	return json_encode($g);
    }

    public function convertWikiToGraph($subject = null) {
    	$this->autoRender = false;

    	pr($this->_convertWikiToGraph($subject));
    }

    private function _convertWikiToGraph($subject) {
    	$this->format = 'php';
    	$result = $this->browseBySubject($subject);
    	$result = unserialize($result);

    	$query = $result['query'];
    	$properties = [];
    	foreach ($query['data'] as $p) {
            $name = $p['property'];
            $items = '';
            $i = 0;
            foreach ($p['dataitem'] as $item) {
            	if ($i++ != 0) {
            		$items .= ', ';
            	}
            	$items .= $item['item'];
            }

            $properties[$name] = $items;
    	}

    	$category = null;
    	$skey = null;
		foreach ($properties as $key => $value) {
			if ($key === '_INST') {
				$category = $value;
			}
			else if ($key === '_SKEY') {
				$skey = $value;
			}
		}

    	$node = ['category' => $category, 'name' => $skey, 'info' => $properties];

    	return ['nodes' => [$node], 'links' => []];
    }

    private function _searchGraph($name, $g) {
        if (is_null($name) || $name === '') {
            return $g;
        }

        $nodes = [];
        $links = [];

    	// nodes in graph
    	foreach ($g['nodes'] as $node) {
    	    if ($node['name'] == $name) {
                array_push($nodes, $node);
            }
        }

    	foreach ($g['links'] as $link) {
    		if ($link['source'] == $name) {
    			array_push($links, $link);
    		}
    	}

    	// inference nodes in relation
    	foreach ($links as $link) {
    		if (in_array($link['name'], ['同事', '党派竞争对手', '共同作者'])) {
    			array_push($nodes, ['category' => '人物', 'name' => $link['target']]);
    		}
    		else if (in_array($link['name'], ['毕业于', '就职于'])) {
    			array_push($nodes, ['category' => '机构', 'name' => $link['target']]);
    		}
    	}

    	return ['nodes' => $nodes, 'links' => $links];
    }

    private function _getLevel1Relations($g) {
    }

    private function _getLevel2Relations($g) {
    }

    private function _generateData() {

    	$n1 = ['category' => '人物', 'name' => 'Shu-Jen Han',
    			'info' => [
    					'Email' => 'sjhan@us.ibm.com',
    					'Tel' => '+19149452876',
    					'Degree' => 'Ph.D. in Materials Sci., Ph.D. minor in Electrical Engineering',
    					'Language' => 'English, Mandarin',
    					'Affiliation' => 'IBM T. J. Watson Research Center',
    					'Occupation' => 'Scientist',
    					'Vocation' => 'Nanoscale Science & Technology'
    			]
    	];

    	$n2 = ['category' => '人物', 'name' => 'Leo Lester',
    			'info' => [
    					'党派' => 'Conservatives',
    					'College' => 'University of Reading, University of Oxford',
    					'Degree' => 'Ph.D., Evolutionary Biology',
    					'Language skill' => 'English, Mandarin',
    					'vocation' => 'Oil',
    					'Occupation' => 'Businessperson',
    					'Orgnization' => 'KAPSARC',
    					'Project' => 'Greater Bongkot South Gas Development',
    					'Publication' => 'Drawing from the Best: Approaches to Modeling China’s Energy Economy, and more'
    			]
    	];

    	$n3 = ['category' => '人物', 'name' => 'Arvind Krishna', 'info' => ['党派' => 'Conservatives']];
    	
    	$n4 = ['category' => '机构', 'name' => 'IBM T. J. Watson Research Center',
    			'info' => [
    					'Homepage' => 'http://www.research.ibm.com/labs/watson/index.shtml',
    					'Alias' => 'IBM Thomas J. Watson Research Center, IBM Research',
    					'Director' => 'Arvind Krishna',
    					'Founding time' => '1961',
    			]
    	];

    	$n5 = ['category' => '人物', 'name' => 'Jeff Hawkins',
    			'info' => [
    					'Affilication' => 'Numenta',
    					'Founded' => 'Palm Computing, Handspring, Numenta',
    					'Facebook' => 'jeff.hawkins.140',
    					'Twitter' => 'JeffCHawkins',
    					'Occupation' => 'Businessperson',
    					'Alma mater' => 'Cornell University',
    					'Born' => 'June 1, 1957'
    			]
    	];

    	$n6 = ['category' => '机构', 'name' => 'Numenta',
    			'info' => [
    					'Homepage' => 'http://www.research.ibm.com/labs/watson/index.shtml',
    					'Industry' => '	Analytics, Artificial Intelligence',
    					'Headquarters' => 'Redwood City, California、U.S.',
    					'Founder' => 'Jeff Hawkins',
    					'Products' => 'Grok for IT Analytics',
    					'Key people' => 'Donna Dubinsky (CEO), Jeff Hawkins (Co-founder),',
    					'Founding time' => '2005',
    			]
    	];

    	$nodes = [$n1, $n2, $n3, $n4, $n5, $n6];

    	$links = [
    			['source' => 'Shu-Jen Han', 'target' => 'Arvind Krishna', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Joan Hart', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Yang Liu', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Hasan Nayfeh', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Faisal Chowdhury', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Fanghao Yang', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Bob Hopkins', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'Emrah Acar', 'name' => '同事'],
    			['source' => 'Shu-Jen Han', 'target' => 'National Tsing Hua University', 'name' => '毕业于'],
    			['source' => 'Shu-Jen Han', 'target' => 'Stanford University', 'name' => '毕业于'],
    			['source' => 'Shu-Jen Han', 'target' => 'IBM T. J. Watson Research Center', 'name' => '就职于'],

    			['source' => 'Leo Lester', 'target' => 'Tony Jones', 'name' => '党派竞争对手', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'James Moore', 'name' => '党派竞争对手', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'Robert Alan Booth', 'name' => '党派竞争对手', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'Axel Pierru', 'name' => '共同作者', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'Brian Efird', 'name' => '共同作者', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'Philipp Galkin', 'name' => '共同作者', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'Brian Efird', 'name' => '共同作者', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'KAPSARC', 'name' => '曾就职于', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'BG Group', 'name' => '曾就职于', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'University of Reading', 'name' => '毕业于', 'weight' => 1],
    			['source' => 'Leo Lester', 'target' => 'University of Oxford', 'name' => '毕业于', 'weight' => 1],
    	
    			['source' => 'Arvind Krishna', 'target' => 'Shu-Jen Han', 'name' => '同事', 'weight' => 1],
    			['source' => 'Arvind Krishna', 'target' => 'Sonia Jain Krishna', 'name' => '同事', 'weight' => 2],
    			['source' => 'Arvind Krishna', 'target' => 'IBM T. J. Watson Research Center', 'name' => '主管', 'weight' => 2],
    	
    			['source' => 'Jeff Hawkins', 'target' => 'Donna Dubinsky', 'name' => '同事', 'weight' => 2],
    			['source' => 'Jeff Hawkins', 'target' => 'Rami Branitzky', 'name' => '同事', 'weight' => 2],
    			['source' => 'Jeff Hawkins', 'target' => 'Numenta', 'name' => '创始人', 'weight' => 2]
    	];

    	$g = ['nodes' => $nodes, 'links' => $links];

    	return $g;
    }
}
