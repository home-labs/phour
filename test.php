<?php

use PHour\Stopwatch ;

$timing = new Stopwatch();
$timing->start();

usleep(3 * 1000000);

$timing->stop();

printf("%02u:%02u.%03.0f.%03.0f", $timing->getRelativeElapsedMinutes(), $timing->getRelativeElapsedSeconds(), $timing->getRelativeElapsedMilliseconds(), $timing->getRelativeElapsedMicroseconds());
