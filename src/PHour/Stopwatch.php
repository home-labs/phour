<?php

namespace PHour;

class Stopwatch {

    private $initialTime;
    
    private $relativeElapsedMicroseconds;
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
//         returns a string in format "microseconds seconds", but the microseconds value it's expressed in seconds
        $finalTime = microtime();

        list($initialMicroseconds, $initialSeconds) = explode(' ', $this->initialTime);
        list($finalMicroseconds, $finalSeconds) = explode(' ', $finalTime);
        
        $this->relativeElapsedMicroseconds = intval(abs($finalMicroseconds - $initialMicroseconds) * 1000000);
        $this->absElapsedSeconds = $finalSeconds - $initialSeconds;
        
        $this->calculateElapsedMicroseconds();
        $this->calculateElapsedMilliseconds();
        $this->calculateElapsedSeconds();
        $this->calculateElapsedMinutes();
        $this->calculateElapsedHours();
    }
    
    private function calculateElapsedHours() {
        $this->elapsedHours = intval($this->absElapsedSeconds / (60 * 60));
    }
    
    private function calculateElapsedMinutes() {
        $containedHours = intval($this->absElapsedSeconds / (60 * 60));
        $absMinutes = intval($this->absElapsedSeconds / 60);
        $this->elapsedMinutes = $absMinutes - ($containedHours * 60);
    }

    private function calculateElapsedSeconds() {
        $containedMinutes = intval($this->absElapsedSeconds / 60);
        $this->elapsedSeconds = $this->absElapsedSeconds - ($containedMinutes * 60);
    }

    private function calculateElapsedMilliseconds() {
        $this->elapsedMilliseconds = intval($this->relativeElapsedMicroseconds / 1000);
    }
    
    private function calculateElapsedMicroseconds() {
        $containedMilliseconds = intval($this->relativeElapsedMicroseconds / 1000);
        $this->elapsedMicroseconds = $this->relativeElapsedMicroseconds - ($containedMilliseconds * 1000);
    }

}
