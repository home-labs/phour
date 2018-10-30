<?php

$rootPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '.');

set_include_path(get_include_path() . PATH_SEPARATOR . implode(DIRECTORY_SEPARATOR, [$rootPath, 'src', 'PHour']));

include_once 'Stopwatch.php';

use PHour\Stopwatch;

$timing = new Stopwatch();
$timing->start();

usleep(800);

$timing->stop();

printf("%02u:%02u:%02u.%003u.%003u",
    $timing->getElapsedHours(),
    $timing->getElapsedMinutes(),
    $timing->getElapsedSeconds(),
    $timing->getElapsedMilliseconds(),
    $timing->getElapsedMicroseconds()
);
