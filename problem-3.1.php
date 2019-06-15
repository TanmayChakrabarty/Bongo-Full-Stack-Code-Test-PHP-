<?php
class tree
{
    var $nodes;

    /**
    * 
    * @param integer $root required
    * 
    * @return true
    */
    public function __construct($root)
    {
        $this->nodes = array();
        $this->nodes[$root] = 0;

        return TRUE;
    }

    /**
    * 
    * @param integer $value required
    * @param integer $parent required
    * 
    * @return true on success, false on failure
    */
    public function addNode($value, $parent)
    {
        if (!isset($this->nodes[$parent]) || !$value) return FALSE;
        else $this->nodes[$value] = $parent;

        return TRUE;
    }

    /**
    * 
    * @param integer $node
    * @param array $path
    * 
    * @return if valid node then an array of path-nodes from root to given node , FALSE otherwise
    */
    public function findPath($node, $path = array())
    {
        if(!isset($this->nodes[$node])) return FALSE;
        $parent = $this->nodes[$node];
        
        array_unshift($path, $node);

        if ($parent !== 0) {
            $path = $this->findPath($parent, $path);
        }

        return $path;
    }

    /**
    * 
    * @param integer $node1
    * @param integer $node2
    * 
    * @return if nodes are valid then least common ancestor, FALSE otherwise
    */
    public function lca($node1, $node2)
    {
        if (!isset($this->nodes[$node1]) && !isset($this->nodes[$node2])) return FALSE; //one or both nodes weren't found
        else if ($node1 == $node2) return $node1;
        else{
            $parent1 = $this->nodes[$node1];
            $parent2 = $this->nodes[$node2];

            if($parent1 == $parent2) return $parent1;
            else{
                $n1Path = $this->findPath($node1);
                $n2Path = $this->findPath($node2);
                if(!$n1Path || !$n2Path) return FALSE;
                $n1PathWeight = count($n1Path);
                $n2PathWeight = count($n2Path);
                $min = $n1PathWeight < $n2PathWeight ? $n1PathWeight : $n2PathWeight;
                $lcaNode = null;
                for($i=0; $i<$min; $i++){
                    if($n1Path[$i] == $n2Path[$i]) $lcaNode = $n1Path[$i];
                    else break;
                }
                return $lcaNode;
            }
        }

    }
}

$theTree = new tree(1);
$theTree->addNode(2,1);
$theTree->addNode(3,1);
$theTree->addNode(4,2);
$theTree->addNode(5,2);
$theTree->addNode(6,3);
$theTree->addNode(7,3);
$theTree->addNode(8,4);
$theTree->addNode(9,4);

echo $theTree->lca(4,8);