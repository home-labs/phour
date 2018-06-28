<?php

namespace PHour;

class Stopwatch {

    private $startingTime;
    private $relativeElapsedMicroseconds;
    private $relativeElapsedMilliseconds;
    private $relativeElapsedMinutes;
    private $absElapsedSeconds;
    private $relativeElapsedSeconds;
//    private $totalElapsedMicroseconds;

    function __construct() {

    }

    function getRelativeElapsedMicroseconds() {
        return $this->relativeElapsedMicroseconds;
    }

    function getRelativeElapsedMilliseconds() {
        return $this->relativeElapsedMilliseconds;
    }

    function getRelativeElapsedSeconds() {
        return $this->relativeElapsedSeconds;
    }

    function getRelativeElapsedMinutes() {
        return $this->relativeElapsedMinutes;
    }

    function start() {
        $this->startingTime = microtime();

        $this->relativeElapsedMicroseconds = 0;
        $this->relativeElapsedMilliseconds = 0;
        $this->relativeElapsedSeconds = 0;
        $this->relativeElapsedMinutes = 0;
    }

    function stop() {
        $stoppingTime = microtime();

        list($initialMicroseconds, $initialSeconds) = explode(' ', $this->startingTime);
        list($finalMicroseconds, $finalSeconds) = explode(' ', $stoppingTime);

        $this->resolveRelativeElapsedMilliseconds($initialMicroseconds, $finalMicroseconds);
        $this->resolveRelativeElapsedMicroseconds();

        $this->resolveRelativeElapsedMinutes($initialSeconds, $finalSeconds);
        $this->resolveRelativeElapsedSeconds();
    }

    private function resolveRelativeElapsedSeconds() {
        $this->relativeElapsedSeconds = $this->absElapsedSeconds % 60;
    }

    private function resolveRelativeElapsedMinutes($initialSeconds, $finalSeconds) {
        $this->absElapsedSeconds = abs($finalSeconds - $initialSeconds);
        $relativeElapsedMinutes = floor($this->absElapsedSeconds / 60);
        if ($relativeElapsedMinutes < 60) {
            $this->relativeElapsedMinutes = $relativeElapsedMinutes;
        }
    }

    private function resolveRelativeElapsedMicroseconds() {
        $this->relativeElapsedMicroseconds = $this->relativeElapsedMicroseconds % 1000;
    }

    private function resolveRelativeElapsedMilliseconds($initialRelativeMicroseconds, $finalRelativeMicroseconds) {
        $this->relativeElapsedMicroseconds = abs($finalRelativeMicroseconds - $initialRelativeMicroseconds) * 1000000;
//        printf("%03.6f", abs($finalRelativeMicroseconds - $initialRelativeMicroseconds));
//        echo "\n";
        $this->relativeElapsedMilliseconds = floor($this->relativeElapsedMicroseconds / 1000);
    }

//    private function setTotalElapsedTime($relativeElapsedMicroseconds, $relativeElapsedSeconds) {
//        $this->totalElapsedMicroseconds = ($relativeElapsedMicroseconds * 1000000) + ($relativeElapsedSeconds * 1000000);
//    }

}
