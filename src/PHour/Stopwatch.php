<?php

namespace PHour;

class Stopwatch {

    private $initialSeconds;
    private $initialRelativeMicroseconds;
    private $currentAbsElapsedSeconds;
    private $currentRelativeElapsedMicroseconds;
    
    private $elapsedMicroseconds;
    private $elapsedMilliseconds;
    private $elapsedSeconds;
    private $elapsedMinutes;
    private $elapsedHours;

    function __construct() { }
    
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
        $initialTime = microtime();
        
        list($this->initialRelativeMicroseconds, $this->initialSeconds) = explode(' ', $initialTime);

        $this->elapsedMicroseconds = 0;
        $this->elapsedMilliseconds = 0;
        $this->elapsedSeconds = 0;
        $this->elapsedMinutes = 0;
        $this->elapsedHours = 0;
    }

    function stop() {
        $this->calculateElapsedMicroseconds();
        $this->calculateElapsedMilliseconds();
        $this->calculateElapsedSeconds();
        $this->calculateElapsedMinutes();
        $this->calculateElapsedHours();
    }
    
    private function catchTime() {
        $currentTime = microtime();
        list($currentRelativeMicroseconds, $currentSeconds) = explode(' ', $currentTime);
        $this->currentRelativeElapsedMicroseconds = intval(
               abs($currentRelativeMicroseconds - 
                   $this->initialRelativeMicroseconds) * 1000000
            );
        $this->currentAbsElapsedSeconds = $currentSeconds - $this->initialSeconds;
    }
    
    private function calculateElapsedHours() {
        $this->catchTime();
        $this->elapsedHours = intval($this->currentAbsElapsedSeconds / (60 * 60));
    }
    
    private function calculateElapsedMinutes() {
        $this->catchTime();
        $containedHours = intval($this->currentAbsElapsedSeconds / (60 * 60));
        $absMinutes = intval($this->currentAbsElapsedSeconds / 60);
        $this->elapsedMinutes = $absMinutes - ($containedHours * 60);
    }

    private function calculateElapsedSeconds() {
        $this->catchTime();
        $containedMinutes = intval($this->currentAbsElapsedSeconds / 60);
        $this->elapsedSeconds = $this->currentAbsElapsedSeconds - ($containedMinutes * 60);
    }

    private function calculateElapsedMilliseconds() {
        $this->catchTime();
        $this->elapsedMilliseconds = intval($this->currentRelativeElapsedMicroseconds / 1000);
    }
    
    private function calculateElapsedMicroseconds() {
        $this->catchTime();
        $containedMilliseconds = intval($this->currentRelativeElapsedMicroseconds / 1000);
        $this->elapsedMicroseconds = $this->currentRelativeElapsedMicroseconds - ($containedMilliseconds * 1000);
    }

}
