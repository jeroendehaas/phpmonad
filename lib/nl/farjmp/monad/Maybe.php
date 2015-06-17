<?php

namespace nl\farjmp\monad;

class Maybe {
    use Monad;

    private $value;

    private function __construct($value) {
        $this->value = $value;
    }

    public static function pure($value) {
        return new Maybe($value);
    }

    public function bind($function) { 
        if ($this->isNothing()) { // only bind on something
            return $this;
        }
        else {
            return $function($this->value);
        }
    
    }

    public function isJust() {
        return $this->value !== null;
    }

    public function isNothing() {
        return !$this->isJust();
    }

    public function getJust() {
        if ($this->isJust()) {
            return $this->value;
        }
        else {
            throw new \Exception("Trying to get a value out of Nothing");
        }
    }
}
