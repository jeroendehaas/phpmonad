<?php

namespace nl\farjmp\monad;

abstract class Monad {

    protected $value;

    public function __construct($value) { 
        $this->value = $value;
    }

    public static function pure($value) {
        return new static($value);
    }

    public abstract function bind($function);

    public function escape() {
        return $this->value;
    }
}
