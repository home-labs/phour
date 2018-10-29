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
//         returns a string in format "microseconds seconds", but the microseconds value it's expressed in seconds
        $finalTime = microtime();

        list($initialMicroseconds, $initialSeconds) = explode(' ', $this->initialTime);
        list($finalMicroseconds, $finalSeconds) = explode(' ', $finalTime);
        
        $this->absElapsedMicroseconds = intval(abs($finalMicroseconds - $initialMicroseconds) * 1000000);
        $this->absElapsedSeconds = $finalSeconds - $initialSeconds;
        
        $this->calculateElapsedHours();
        $this->calculateElapsedMinutes();
        $this->calculateElapsedSeconds();
        $this->calculateElapsedMilliseconds();
        $this->calculateElapsedMicroseconds();
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
        $this->elapsedMilliseconds = intval($this->absElapsedMicroseconds / 1000);
    }
    
    private function calculateElapsedMicroseconds() {
        $containedMilliseconds = intval($this->absElapsedMicroseconds / 1000);
        $this->elapsedMicroseconds = $this->absElapsedMicroseconds - ($containedMilliseconds * 1000);
    }

}
