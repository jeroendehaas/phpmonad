<?php

namespace nl\farjmp\monad;

class Either {
    use Monad;

    private $left;
    private $right;

    private function __construct($left, $right) {
        $this->left = $left;
        $this->right = $right;
    }

    public static function right($value) {
        return new self(null, $value);
    }

    public static function left($value) {
        return new self($value, null); } 
    public static function pure($value) {
        return self::right($value);
    }

    public function isLeft() {
        return $this->left !== null;
    }

    public function isRight() {
        return $this->right !== null;
    }

    public function getLeft() {
        if ($this->isLeft()) {
            return $this->left;
        }
        else {
            throw new \Exception("Cannot get left value from Right");
        }
    }

    public function getRight() {
        if ($this->isRight()) {
            return $this->right;
        }
        else {
            throw new \Exception("Cannot get right value from Left");
        }
    }

    public function bind($function) {
        if ($this->isRight()) {
            return $function($this->getRight());
        }
        else {
            return $this;
        }
    }

    public function bindWithCatch($function) {
        try {
            return $this->bind($function);
        }
        catch (\Exception $e) {
            return self::left($e);
        }
    }
}
