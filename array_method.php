<?php
$members = array (
    0 => array (
        0 => array(
            'id' => 1,
            'name' => 'Bob'
        ),
        1 => array(
            'id' => 2,
            'name' => 'John'
        ),
        2 => array(
            'id' => 3,
            'name' => 'Ben'
        )
    ),
    1 => array (
        0 => array(
            'id' => 4,
            'name' => 'Kate'
        ),
        1 => array(
            'id' => 5,
            'name' => 'Jane'
        )
    )
);

// var_dump($members[0][0]['id']);

$merge_members = call_user_func_array("array_merge", $members);
// $merge_members = call_user_func_array("array_merge", $merge_members);
// var_dump($merge_members[0]);

// $arr = array(
//     array(1, 2, 3),
//     array(1, 2, 3),
//     array(1, 2, 3),
// );
 
// $result = array_reduce($arr, 'array_merge', array());

// var_dump($result);