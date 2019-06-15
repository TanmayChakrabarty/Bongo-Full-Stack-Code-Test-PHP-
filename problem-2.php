<?php
/**
* 
* @param array|object $data required
* @param integer $level optional, default value 1
* 
* @return nothing
* 
* print depths of the keys in the array|object
*/
function printDepth($data, $level = 1)
{
    if (!is_array($data) && !is_object($data)) return false;
    else {
        foreach ($data as $i=>$v) {
            echo "$i $level<br />";
            if (is_array($v) || is_object($v)) printDepth($v, $level + 1);
        }
    }
}

class Person
{
    public function __construct($first_name, $last_name, $father)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->father = $father;
    }
}

$input = array(
    'key1' => '1',
    'key2' => array(
        'key3' => '1',
        'key4' => array(
            'key5' => new Person('A', 'B', 'C')
        ),
        'key6' => new Person('F', 'G', 'H'),
    ),
    'key7' => 8
);

printDepth($input);