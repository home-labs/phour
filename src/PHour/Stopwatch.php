<?php

namespace PHour;

class Stopwatch {

    private $initialTime;
    
    private $absElapsedMicroseconds;
    private $absElapsedSeconds;
    
    private $elapsedMicroseconds;
    private $elapsedMilliseconds;
    private $elapsedSeconds;
    private $elapsedMinutes;
    private $elapsedHours;

    function __construct() {

    }
    
    function getElapsedHours() {
        return $this->elapsedHours;
    }
    
    function getElapsedMinutes() {
        return $this->elapsedMinutes;
    }
    
    function getElapsedSeconds() {
        return $this->elapsedSeconds;
    }
    
    function getElapsedMilliseconds() {
        return $this->elapsedMilliseconds;
    }

    function getElapsedMicroseconds() {
        return $this->elapsedMicroseconds;
    }

    function start() {
        $this->initialTime = microtime();

        $this->elapsedMicroseconds = 0;
        $this->elapsedMilliseconds = 0;
        $this->elapsedSeconds = 0;
        $this->elapsedMinutes = 0;
        $this->elapsedHours = 0;
    }

    function stop() {
        $finalTime = microtime();

        list($initialMicroseconds, $initialSeconds) = explode(' ', $this->initialTime);
        list($finalMicroseconds, $finalSeconds) = explode(' ', $finalTime);
        
        $this->absElapsedMicroseconds = $finalMicroseconds - $initialMicroseconds;
        $this->absElapsedSeconds = $finalSeconds - $initialSeconds;
        
        $this->calculateElapsedHours();
        $this->calculateElapsedMinutes();
        $this->calculateElapsedSeconds();
        $this->calculateElapsedMilliseconds();
        $this->calculateElapsedMicroseconds();
    }
    
    private function calculateElapsedHours() {
        $containedSecondsInMinute = 60;
        $containedSecondsInHour = $containedSecondsInMinute * 60;
        $this->elapsedHours = intval($this->absElapsedSeconds / $containedSecondsInHour);
    }
    
    private function calculateElapsedMinutes() {
        $containedSecondsInMinute = 60;
        $containedSecondsInHour = $containedSecondsInMinute * 60;
        $this->elapsedMinutes = intval($this->absElapsedSeconds / $containedSecondsInMinute) - 
            intval($this->absElapsedSeconds / $containedSecondsInHour);
    }

    private function calculateElapsedSeconds() {
        $this->elapsedSeconds = $this->absElapsedSeconds - intval($this->absElapsedSeconds / 60);
    }

    private function calculateElapsedMilliseconds() {
        $this->elapsedMilliseconds = floor($this->absElapsedMicroseconds / 1000);
    }
    
    private function calculateElapsedMicroseconds() {
        $this->elapsedMicroseconds = $this->absElapsedMicroseconds - 
            floor($this->absElapsedMicroseconds / 1000);
    }

}
