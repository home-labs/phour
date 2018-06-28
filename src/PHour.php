<?php

namespace PHour;

class Stopwatch {

    private $startingTime;
    private $stoppingTime;
    private $elapsedMicroseconds;
    private $elapsedMilliseconds;
    private $elapsedSeconds;
    private $elapsedMinutes;

    function __construct() {

    }

    function getElapsedMicroseconds() {
        return $this->elapsedMicroseconds;
    }

    function getElapsedMilliseconds() {
        return $this->elapsedMilliseconds;
    }

    function getElapsedSeconds() {
        return $this->elapsedSeconds;
    }

    function getElapsedMinutes() {
        return $this->elapsedMinutes;
    }

    function start() {
        $this->startingTime = microtime();

        $this->elapsedMicroseconds = 0;
        $this->elapsedMilliseconds = 0;
        $this->elapsedSeconds = 0;
        $this->elapsedMinutes = 0;
    }

    function stop() {
        $this->stoppingTime = microtime();

        list($initialMicroseconds, $initialSeconds) = explode(' ', $this->startingTime);
        list($finalMicroseconds, $finalSeconds) = explode(' ', $this->stoppingTime);

        $elapsedMicroseconds = abs($finalMicroseconds - $initialMicroseconds);
//        can to do also convert the difference between seconds to microsecond and add with this, and only after that calculate seconds, minutes, etc. but the base would be the smallest unit
        $this->elapsedMilliseconds = round($elapsedMicroseconds / 1000);

        if ($this->elapsedMilliseconds) {
            $this->elapsedMicroseconds = ($this->elapsedMilliseconds * 1000) - $elapsedMicroseconds;
        } else {
            $this->elapsedMicroseconds = $elapsedMicroseconds;
        }

        $elapsedSeconds = abs($finalSeconds - $initialSeconds);
        $this->elapsedMinutes = round($elapsedSeconds / 60);
        if ($this->elapsedMinutes) {
            $this->elapsedSeconds = ($this->elapsedMinutes * 60) - $elapsedSeconds;
        } else {
            $this->elapsedSeconds = $elapsedSeconds;
        }
    }

}
