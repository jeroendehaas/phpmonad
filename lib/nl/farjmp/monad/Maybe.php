<?php

namespace nl\farjmp\monad;

class Maybe extends Monad {

    protected $value;

    public function __construct($value) {
        $this->value = $value;
    }


    public function bind($function) { 
        if ($this->value === null) {
            return self::pure(null);
        }
        else {
            return $function($this->value);
        }
    
    }
}
