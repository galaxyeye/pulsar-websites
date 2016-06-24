<?php 

class Node {

    private $_id;

    private $_category;

    private $_name;

    private $_info = [];

    /**
     * Stores the reference to the next node.
     * @var Node
     */
    private $_nextNode;

    /**
     * Initializes the node.
     * @param int $id
     * @param Node $nextNode
     */
    public function __construct($id, $name = null, $category = null, $info = [], Node $nextNode = null) {
        $this->_id = $id;
        $this->_name = $name;
        $this->_category = $category;
        $this->_info = $info;
        $this->_nextNode = $nextNode;
    }

    /**
     * Sets the id.
     * @param int $id
     */
    public function setId($id) {
        $this->_id = $id;
    }

    /**
     * Returns the id.
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    public function setName($name) {
    	$this->_name = $name;
    }

    public function getName() {
    	return $this->_name;
    }

    public function setCategory($category) {
    	$this->_category = $category;
    }
    
    public function getCategory() {
    	return $this->_category;
    }

    public function setInfo($info) {
    	$this->_info = $info;
    }

    public function getInfo() {
    	return $this->_info;
    }

    public function setNextNode(Node $nextNode = null) {
        $this->_nextNode = $nextNode;
    }

    /**
     * Returns the next node.
     * @return Node
     */
    public function getNextNode() {
        return $this->_nextNode;
    }
} 