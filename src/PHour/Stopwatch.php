<?php

namespace PHour;

class Stopwatch {

    private $startingTime;
    private $elapsedMicroseconds;
    private $elapsedMilliseconds;
    private $elapsedSeconds;
    private $elapsedMinutes;
    private $absElapsedMicroseconds;
    private $absElapsedSeconds;

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
        $stoppingTime = microtime();

        list($initialMicroseconds, $initialSeconds) = explode(' ', $this->startingTime);
        list($finalMicroseconds, $finalSeconds) = explode(' ', $stoppingTime);

        $this->resolveElapsedMilliseconds($initialMicroseconds, $finalMicroseconds);
        $this->resolveElapsedMicroseconds();

        $elapsedSeconds = abs($finalSeconds - $initialSeconds);
        $this->elapsedMinutes = round($elapsedSeconds / 60);
        if ($this->elapsedMinutes) {
            $this->elapsedSeconds = ($this->elapsedMinutes * 60) - $elapsedSeconds;
        } else {
            $this->elapsedSeconds = $elapsedSeconds;
        }
    }

    private function resolveElapsedMicroseconds() {
        $this->elapsedMicroseconds = $this->absElapsedMicroseconds % 1000;
    }

    private function resolveElapsedMilliseconds($initialMicroseconds, $finalMicroseconds) {
        $this->absElapsedMicroseconds = abs($finalMicroseconds - $initialMicroseconds);
        $this->elapsedMilliseconds = floor($this->absElapsedMicroseconds * 1000);
    }

}
