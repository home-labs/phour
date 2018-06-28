<?php

require_once('./load-paths.php');
require_once('./autoload.php');

use GraphIte\AssociativeArray;

$arr = array(
    'a' => array(
        'a.1' => array(
            'a.1.1' => 'a.1.1',
            'a.1.2' => 'a.1.2'
        ),
        'a.2' => array(
            'a.2.1' => 'a.2.1',
            'a.2.2' => 'a.2.2'
        )
    ),
    'b' => array(
        'b.1' => array(
            'b.1.1' => 'b.1.1',
            'b.1.2' => 'b.1.2'
        ),
        'b.2' => 'b.2'
    )
);

//$arr = [1, 2, 3, [4, 5, 6, [7, 8, 9]]];

$associativeIterator = new AssociativeArray($arr);

//$associativeIterator->stopAtNext();
foreach ($associativeIterator as $key => $value) {
    echo 'key: ' . $key . "\n";
    echo 'value: ' . json_encode($value) . "\n";
//    $bfsArray->stopAtNext();
//    break;
}
