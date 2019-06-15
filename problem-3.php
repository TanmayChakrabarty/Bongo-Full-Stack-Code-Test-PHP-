<?php
/**
* In this implementation, I have used the given class, but I couldn't actually utilize it, I mean, I failed to find out the reason for using the node class
* Thus I prepared another solution, same as this one, but skipping the node class, which can be found at problem-3.1.php
* 
* In this, (also in problem-3.1) I find the path of your two given nodes (from root to node). Then I loop through the elements of the shorter path and break the loop when the node can not be found in the other path.
* 
* Memory: using separate objects for nodes and storing the nodes in the tree structure is memory inefficient, so this solution going to take more than expected memory
* 
* Runtime Complexity: the lca(n1,n2) method invokes another @method findPath($node, $path) twice, here the complexity will be of O(N) where N is the depth of the node. the lca(n1, n2) is again O(N) where N is the depth of the less deep node
* 
*/
class node
{
    var $value;
    var $parent;

    public function __construct($value, $parent)
    {
        $this->value = $value;
        $this->parent = $parent;
    }
}
class tree
{
    var $nodes;

    /**
    * 
    * @param node $root
    * 
    * @return true on success, false on failure
    * 
    * When initializing the root node must have its parent set to NULL, otherwise it will be ignored
    */
    public function __construct(node $root)
    {
        $this->nodes = array();
        if ($root->parent !== NULL) return FALSE;
        else $this->nodes[$root->value] = $root;

        return TRUE;
    }

    /**
    * 
    * @param node $node
    * 
    * @return true on success, false on failure
    */
    public function addNode($node)
    {
        if (!$this->nodes || $node->parent === NULL) return FALSE;
        else $this->nodes[$node->value] = $node;

        return TRUE;
    }

    /**
    * 
    * @param integer $node
    * @param array $path
    * 
    * @return an array of path-nodes from root to given node
    */
    public function findPath($node, $path = array())
    {
        $node = $this->nodes[$node];
        array_unshift($path, $node->value);

        if ($node->parent !== NULL) {
            $path = $this->findPath($node->parent, $path);
        }

        return $path;
    }

    /**
    * 
    * @param integer $node1
    * @param integer $node2
    * 
    * @return least common ancestor
    */
    public function lca($node1, $node2)
    {
        if (!isset($this->nodes[$node1]) && !isset($this->nodes[$node2])) return FALSE; //one or both nodes weren't found
        else if ($node1 == $node2) return $node1;
        else{
            $n1 = $this->nodes[$node1];
            $n2 = $this->nodes[$node2];

            if($n1->parent == $n2->parent) return $n1->parent;
            else{
                $n1Path = $this->findPath($node1);
                $n2Path = $this->findPath($node2);
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

$theTree = new tree(new node(1, NULL));
$theTree->addNode(new node(2,1));
$theTree->addNode(new node(3,1));
$theTree->addNode(new node(4,2));
$theTree->addNode(new node(5,2));
$theTree->addNode(new node(6,3));
$theTree->addNode(new node(7,3));
$theTree->addNode(new node(8,4));
$theTree->addNode(new node(9,4));

echo $theTree->lca(9,3);