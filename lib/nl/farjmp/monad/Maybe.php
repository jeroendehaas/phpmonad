<?php

namespace nl\farjmp\monad;

class Maybe extends Monad {


    public function __construct($value) {
        parent::__construct($value);
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
