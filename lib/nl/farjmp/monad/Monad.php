<?php

namespace nl\farjmp\monad;

abstract class Monad {

    public function __construct($value) { 
    }

    public static function pure($value) {
        return new static($value);
    }

    public abstract function bind($function);
}
