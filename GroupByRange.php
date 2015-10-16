<?php 
class BinaryNode
{
    public $value;    // contains the node item
    public $left;     // the left child BinaryNode
    public $right;     // the right child BinaryNode

    public function __construct($item) {
        $this->value = $item;
        // new nodes are leaf nodes
        $this->left = null;
        $this->right = null;
    }
    
    public function dump() {
        if ($this->left !== null) {
            $this->left->dump();
        }
        var_dump($this->value);
        if ($this->right !== null) {
            $this->right->dump();
        }
    }
    public function SortedArray() {
        $result=array();
        if ($this->left !== null) {
            $result=$this->left->SortedArray();
        }
        $result[]=$this->value;
        if ($this->right !== null) {
            //$this->right->SortedArray();
            $result=array_merge($result,$this->right->SortedArray());
        }
        
        return($result);
    }
}

class BinaryTree
{
    protected $root; // the root node of our tree

    public function __construct() {
        $this->root = null;
    }

    public function isEmpty() {
        return $this->root === null;
    }
    
    public function insert($item) {
        $node = new BinaryNode($item);
        if ($this->isEmpty()) {
            // special case if tree is empty
            $this->root = $node;
        }
        else {
            // insert the node somewhere in the tree starting at the root
            $this->insertNode($node, $this->root);
        }
    }
  
    protected function insertNode($node, &$subtree) {
        if ($subtree === null) {
            // insert node here if subtree is empty
            $subtree = $node;
        }
        else {
            if ($node->value > $subtree->value) {
                // keep trying to insert right
                $this->insertNode($node, $subtree->right);
            }
            else if ($node->value < $subtree->value) {
                // keep trying to insert left
                $this->insertNode($node, $subtree->left);
            }
            else {
                // reject duplicates
            }
        }
    }

    public function traverse() {
        // dump the tree rooted at "root"
        return($this->root->SortedArray());
    }
    
}

class GroupByRange{
    public $range=null;
    function __construct()
    {
        
    }
    
    function ranges()
    {
        $groups=array();
        $Indexes=new BinaryTree();
        if( $this->range === null  )
            return($groups);
        
        
        foreach(func_get_args() as $number_set)
        {
            if(is_int($number_set))
            {
                $number_set=intval($number_set);
                if($number_set<0)
                    $assigned_range=ceil(abs($number_set)/$this->range)*-1;
                else
                    $assigned_range=ceil(abs($number_set)/$this->range);
                $Indexes->insert($assigned_range);
                if(!isset($groups[$assigned_range]))$groups[$assigned_range]=new BinaryTree();
                $groups[$assigned_range]->insert($number_set);
            }
            else
            {
                throw new InvalidArgumentException('This method only accpets integers:'.$number_set);
            }
        }
        $array_indexes=$Indexes->traverse();
        $returned_array=array();
        print_r($array_indexes);
        print_r(array_keys($groups));
        
        foreach($array_indexes as $index)
        {
            $returned_array[]=$groups[ $index ]->traverse();
        }
        
        return($returned_array);
    }
}

?>
