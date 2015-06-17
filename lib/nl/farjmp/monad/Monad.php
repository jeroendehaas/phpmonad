<?php

namespace nl\farjmp\monad;

trait Monad {
    public abstract static function pure($value);

    public abstract function bind($function);
}
