<?php

namespace nl\farjmp\monad;

trait Monad {
    public abstract function bind($function);
}
