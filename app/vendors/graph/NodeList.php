<?php

class NodeList {
    /**
     * The reference to the first node in the list.
     * @var Node
     */
    private $_head;

    /**
     * Initialized with null as head.
     */
    public function __construct() {
        $this->_head = null;
    }

    /**
     * Sets the head-element.
     * @param Node $head
     */
    public function setHead(Node $head) {
        $this->_head = $head;
    }

    /**
     * Returns the head-element.
     * @return Node
     */
    public function getHead() {
        return $this->_head;
    }
} 