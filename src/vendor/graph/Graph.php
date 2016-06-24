<?php

class Graph {
    /**
     * Stores the single Vertices as NodeList-objects
     * @var Array|NodeList
     */
    private $_vertices;

    /**
     * Initializes the vertices-array.
     * @param $numVertices
     */
    public function __construct($numVertices) {
        $this->_vertices = array();

        for ($i = 0; $i < $numVertices; $i++) {
            $this->_vertices[$i] = new NodeList();
        }
    }

    /**
     * Returns the number of vertices.
     * @return int
     */
    public function getNumVertices() {
        return sizeof($this->_vertices);
    }

    /**
     * Returns the vertices.
     * @return Array|NodeList
     */
    public function getVertices() {
        return $this->_vertices;
    }

    /**
     * Adds an edge between two vertices.
     *
     * @param int $source
     * @param int $destination
     *
     * @throws OutOfBoundsException
     */
    public function addEdge($source, $destination) {
        $sourceOutOfBounds = $source < 0 || $source >= sizeof($this->_vertices);
        $destinationOutOfBounds = $destination < 0 || $destination >= sizeof($this->_vertices);

        if ($sourceOutOfBounds || $destinationOutOfBounds) {
            throw new OutOfBoundsException("Source or destination out of bounds.");
        }

        $destinationNode = new Node($destination);
        $destinationNode->setNextNode($this->_vertices[$source]->getHead());

        $this->_vertices[$source]->setHead($destinationNode);
    }

    /**
     * "Prints" the graph in the most simple way.
     */
    public function printGraph() {
        for ($i = 0; $i < $this->getNumVertices(); $i++) {
            $nextNode = $this->_vertices[$i]->getHead();

            if (is_null($nextNode)) {
                echo 'Vertex "' . $i . '" has no edges ... <br>';
                continue;
            }

            echo 'Vertex "' . $i . '" has edges to: <br>';

            while ($nextNode instanceof Node) {
                echo '-- ' . $nextNode->getId() . '<br>';
                $nextNode = $nextNode->getNextNode();
            }
        }
    }
} 