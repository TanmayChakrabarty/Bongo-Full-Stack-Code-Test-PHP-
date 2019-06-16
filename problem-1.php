<?php
/**
* 
* @param array $data required
* @param integer $level optional, default value 1
* 
* @return nothing
* 
* print depths of the keys in the array
*/
function printDepth($data, $level = 1)
{
    if(!is_array($data)) return false;
    else{
        foreach($data as $i=>$v){
            echo "$i $level<br />";
            if(is_array($v)) printDepth($v, $level+1);
        }
    }
}

$input = array(
    'key1' => '1',
    'key2' => array(
        'key3' => '1',
        'key4' => array(
            'key5' => 4
        ),
        'key6' => 2,
    ),
    'key7' => 8
);

//printDepth($input);