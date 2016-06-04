<?php

class UndirectedGraph extends Graph {
    /**
     * Adds edges in both directions.
     * @param int $source
     * @param int $destination
     */
    public function addEdge($source, $destination) {
        parent::addEdge($source, $destination);

        $vertices = $this->getVertices();

        $sourceNode = new Node($source);
        $sourceNode->setNextNode($vertices[$destination]->getHead());

        $vertices[$destination]->setHead($sourceNode);
    }
}