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
class CommonController extends AppController {

    public function beforeFilter() {
      parent::beforeFilter();
        $this->Auth->allowedActions = array('*');
    }

    public function regexGenerator() {
        if (!empty($this->data)) {
            $urls =  $this->data['Common']['urls'];
            $regex = generatorSimpleRegex($urls);

            $this->set(compact('regex'));
        }
    }

    public function ajax_listCities($provinceId) {
        $this->loadModel('Area');
        $cityOption = $this->Area->find('list', array('fields' => array('id', 'name'), 
                'conditions' => array('city_id' => $provinceId)));

        echo json_encode($cityOption);
    }

    public function ajax_checkUrlAvailable() {
        App::import('Lib', array('http_client'));
        $client = new HttpClient();

        $url = $this->params['url']['u'];
        $exists = $client->url_exists($url);

        echo json_encode(['status' => 'success', 'value' => $exists]);

        $this->autoRender = false;
    }

    public function graph($name = null) {
    	$this->autoRender = false;

        return $this->ajax_graph($name);
    }

    public function ajax_graph($name = null) {
    	$this->autoRender = false;
        header('Access-Control-Allow-Origin: *');

        $nodes = [
            ['category' => '人物', 'name' => 'Shu-Jen Han', 'info' => ['Email' => 'sjhan@us.ibm.com', 'Tel' => '+19149452876']],
            ['category' => '人物', 'name' => 'Leo Lester', 'info' => ['党派' => 'Reading Borough Conservatives']],
            ['category' => '人物', 'name' => 'Arvind Krishna', 'info' => ['党派' => '']],

            ['category' => '机构', 'name' => 'IBM T. J. Watson Research Center', 
                    'profile' => ['Homepage' => 'http://www.research.ibm.com/labs/watson/index.shtml']
            ],
        ];

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
            ['source' => 'Arvind Krishna', 'target' => 'IBM T. J. Watson Research Center', 'name' => '主管', 'weight' => 2]
        ];

        // inference nodes in relation
        foreach ($links as $link) {
            if (in_array($link['name'], ['同事', '党派竞争对手', '共同作者'])) {
                array_push($nodes, ['category' => '人物', 'name' => $link['target']]);
            }
            else if (in_array($link['name'], ['毕业于', '就职于'])) {
                array_push($nodes, ['category' => '机构', 'name' => $link['target']]);
            }
        }

        return $this->_searchGraph($name, ['nodes' => $nodes, 'links' => $links]);
    }

    public function _searchGraph($name, $g) {
        if (is_null($name)) {
          return json_encode($g);
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

        return json_encode(['nodes' => $nodes, 'links' => $links]);
    }

    public function ajax_kissyPictureUpload() {
        Configure::Write('debug', 0);
        $this->autoRender = false;

        //if ($this->currentUser['id'] == 0) {
            //echo json_encode(array(1, '请先登录'));
            //exit();
        //}

        if($_FILES['imgFile']['error'] > 0) {
            switch($_FILES['file']['error']) {
                case 1:
                    echo json_encode(array(1, '文件大小超过服务器限制'));
                break;
                case 2:
                    echo json_encode(array(1, '文件太大！'));
                break;
                case 3:
                    echo json_encode(array(1, '文件只加载了一部分！'));
                break;
                case 4:
                    echo json_encode(array(1, '文件加载失败！'));
                break;
            }

            exit();
        }

        if($_FILES['imgFile']['size'] > 1000000){
            echo json_encode(array(1, '文件过大！'));
            exit();
        }

        App::import('Sanitize');
        if (!empty($_FILES['imgFile']) && is_uploaded_file($_FILES['imgFile']['tmp_name'])){
            $f = $_FILES['imgFile'];
            $path = 'uploads/kissy/'.$this->currentUser['id'].'-'.date("ymdHis").".".end(explode(".", $f['name'] ));
            $dest = IMAGES.$path;

              copy($f['tmp_name'], $dest);
             unlink($f['tmp_name']);

            echo json_encode(array(0, $this->webroot.'img/'.$path));
            $this->log('File has been saved as:'.$dest, LOG_DEBUG);
        }
        else {
            echo json_encode(array(1, '文件加载失败！'));
        }

        exit();
    }
    
    public function bmap() {
        
    }

    public function bmarker() {
        $orderIds = isset($this->params['named']['orderIds']) ? $this->params['named']['orderIds'] : '';
        $this->loadModel('Geo');
        $geos = $this->Geo->find('all', array('conditions' => array(
            'order_id' => array_unique(explode(',', $orderIds)))));

        $this->set(compact('geos'));
    }

    // 上传并切割图片
    public function ajax_PictureUpload($op = null, $type=null) {
        Configure::Write('debug', 0);
        $this->autoRender = false;
        
        switch ($op)
        {
            //上传图片
            case "upload":
                if ($type == null) break;
                $path = ''; //上传路径
                switch ($type) {
                    case 'portal_ad': $path = 'uploads/portals/portalad_pic/'; break;
                }

                if(!file_exists(IMAGES.$path))
                {
                    //检查是否有该文件夹，如果没有就创建，并给予最高权限
                    mkdir(IMAGES."$path", 0700);
                }//END IF
        
                //允许上传的文件格式
                $tp = array("image/gif","image/pjpeg","image/jpeg","image/png");
                //检查上传文件是否在允许上传的类型
                if(!in_array($_FILES["filename"]["type"],$tp))
                {
                    echo "格式不对";
                    exit;
                }//END IF
        
                if($_FILES["filename"]["name"])
                {
                    $file1=$this->_randStr(3,'all');
                    $file2 = $path.time()."_".$file1;
                    $flag=1;
                }//END IF
                $filename=$file2.".".end(explode(".", $_FILES["filename"]["name"])) ;
                if($flag) $result=move_uploaded_file($_FILES["filename"]["tmp_name"],IMAGES.$filename);
                //特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
                if($result)
                {
                    echo "{msg:'文件上传成功!!!',filename:'".$filename."'}";
                }
                else
                {
                    echo "{msg:'文件上传失败!!!'}";
                }
                break;
        
                //编辑图片
            case "edit":
                $x1=$_POST['x1'];
                $x2=$_POST['x2'];
                $y1=$_POST['y1'];
                $y2=$_POST['y2'];
                $w=$_POST['width'];
                $h=$_POST['height'];
                $filename=$_POST['filename'];
                
                $editfilename=$this->_cutImg($filename,$x1,$x2,$y1,$y2,$w,$h);
                echo  '{"msg":"文件编辑成功","filename":"'.$editfilename.'"}';
                break;
        
            default:
                echo "{erro:'系统错误！！！'}";
                break;
        
        }
    }

    //裁剪图片
    private function _cutImg($o_file,$x1,$x2,$y1,$y2,$w,$h) {
        $file=basename($o_file);//文件
        $ext=end(explode(".", $file));//扩展名
        $filename=basename($file,$ext);//文件名

        $filelen=strlen($file);
        $path=substr($o_file,0,strlen(($o_file))-$filelen);//文件夹

        $newfile=$path."edit_".$file;//新文件名

        header('Content-type: image/jpeg');
        list($width, $height) = getimagesize(IMAGES.$o_file);

        $part_width = $x2-$x1;
        $part_height = $y2-$y1;

        $image_n = imagecreatetruecolor($w, $h);
        $image = imagecreatefromjpeg(IMAGES.$o_file);

        imagecopyresampled($image_n, $image, 0, 0, $x1, $y1, $w, $h, $part_width, $part_height);

        //输出文件
        imagejpeg($image_n, IMAGES.$newfile, 85);

        return $newfile;
    }

    //获取随机字符
    private function _randStr($len,$format) {
        switch($format) {
            case 'ALL':
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;
            case 'CHAR':
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; break;
            case 'NUMBER':
                $chars='0123456789'; break;
            default :
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        }
        mt_srand((double)microtime()*1000000*getmypid());
        $password="";
        while(strlen($password)<$len)
        $password.=substr($chars,(mt_rand()%strlen($chars)),1);
        return $password;
    }
}

