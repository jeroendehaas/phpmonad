<?php

namespace nl\farjmp\monad;

class EitherTest extends \PHPUnit_Framework_TestCase
{
    private static $leftValue = "error";
    private static $rightValue = "result";
    private $left;
    private $right;

    public function setUp() {
        $this->left = Either::left(self::$leftValue);
        $this->right = Either::right(self::$rightValue);
    }

    public function testIsLeft() {
        $this->assertTrue($this->left->isLeft());
        $this->assertFalse($this->right->isLeft());
    }

    public function testIsRight() {
        $this->assertFalse($this->left->isRight());
        $this->assertTrue($this->right->isRight());
    }

    public function testGetLeftShouldReturnLeftValue() {
        $this->assertEquals(self::$leftValue, $this->left->getLeft());
    }

    public function testGetLeftShouldThrowExceptionForRight() {
        $this->setExpectedException('Exception');
        $this->right->getLeft();
    }

    public function testGetRightShouldReturnRightValue() {
        $this->assertEquals(self::$rightValue, $this->right->getRight());
    }

    public function testGetRightShouldThrowExceptionForLeft() {
        $this->setExpectedException('Exception');
        $this->left->getRight();
    }

    public function testBindShouldReturnLeftForLeft() {
        $this->assertEquals($this->left, $this->left->bind(function(){}));
    }

    public function testBindShouldBindForRight() {
        $nextLeftValue = "error2";
        $nextLeft = $this->right->bind(function($value) use (&$nextLeftValue) {
            return Either::left($nextLeftValue);
        });
        $this->assertTrue($nextLeft->isLeft());
        $this->assertEquals($nextLeftValue, $nextLeft->getLeft());

        $nextRightValue = "result2";
        $nextRight = $this->right->bind(function($value) use (&$nextRightValue) {
            return Either::right($nextRightValue);
        });
        $this->assertTrue($nextRight->isRight());
        $this->assertEquals($nextRightValue, $nextRight->getRight());
    }

    public function testBindWithCatchShouldCatchExceptionInLeft() {
        $e = new \Exception("thrownInBind");
        $next = $this->right->bindWithCatch(function($value) use (&$e) {
            throw $e;
        });
        $this->assertTrue($next->isLeft());
        $this->assertEquals($e, $next->getLeft());

    }

    public function testBindWithCatchShouldReturnLeftForLeft() {
        $this->assertEquals($this->left, $this->left->bindWithCatch(function(){}));
    }

    public function testBindWithCatchShouldReturnBindForRight() {
        $nextRightValue = "success";
        $nextRight = $this->right->bindWithCatch(function ($value) use (&$nextRightValue) {
            return Either::right($nextRightValue);
        });
        $this->assertTrue($nextRight->isRight());
        $this->assertEquals($nextRightValue, $nextRight->getRight());
    }
}
