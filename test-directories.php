<?php

require_once('./load-paths.php');
require_once('./autoload.php');

use GraphIte\PHour;

$paths = explode(PATH_SEPARATOR, get_include_path());
$paths = ['C:'];

$directoryIterator = new PHour($paths);

$dateTime = new DateTime();

//$startTime = getdate();
//$startTime = microtime(true);
//$time = $startTime;
$startTime = microtime();

//$startTime = $dateTime->getTimestamp();
//$formatedStartTime = DateTime::createFromFormat('U.u', $startTime);
foreach ($directoryIterator as $path) {
    echo $path . "\n";

//    $time = getdate();
//    $time = microtime(true);
    $time = microtime();
//    $time = $dateTime->getTimestamp();
//    $time = (new DateTime())->getTimestamp();
//    $time += microtime(true);
}

echo 'start: ' . $startTime . "\n";
echo 'end: ' . $time . "\n";

//$difference = (float)$time - (float)$startTime;

//$microseconds = $difference;
//$milliseconds = $difference / 1000;
//$seconds = $milliseconds / 1000;
//
//echo 'microseconds: ' . $microseconds . "\n";
//echo 'microseconds: ' . round($microseconds, 4) . "\n";
//echo 'microseconds: ' . $microseconds . "\n";
//echo 'milliseconds: ' . $milliseconds . "\n";
//
//$minutes = $seconds / 60;
//
//echo 'seconds: ' . round($seconds, 2) . "\n";
//echo 'minutes: ' . round($minutes, 2) . "\n";
