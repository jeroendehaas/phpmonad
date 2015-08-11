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

    public function getOrElse($default) {
        return $this->isJust() ? $this->getJust() : $default;
    }

    /**
     * Returns the value of a Just instance or
     * the result of the given function if this Maybe
     * is a Nothing.
     *
     * @param function Function to call if isNothing(), should return a value.
     * @return mixed
     */
    public function getOrElseFn($function) {
        return $this->isJust() ? $this->getJust() : $function();
    }
}
