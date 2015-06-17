<?php

namespace nl\farjmp\monad;

class MaybeTest extends \PHPUnit_Framework_TestCase
{
    public function testPure() {
        $this->assertTrue(Maybe::pure("just") instanceof Maybe);
        $this->assertTrue(Maybe::pure(null) instanceof Maybe);
    }

    public function testMaybeNullShouldNotBind() {
        $testCase = $this;
        Maybe::pure(null)->bind(function($value) use (&$testCase) {
            $testCase->assertTrue(false);
        });
    }

    public function testMaybeJustShouldBind() {
        $testValue = "something";
        Maybe::pure($testValue)->bind(function($value) use (&$testValue) {
            $this->assertEquals($testValue, $value);
        });
    }

    public function testIsNothing() {
        $just = Maybe::pure("just");
        $nothing = Maybe::pure(null);
        $this->assertFalse($just->isNothing());
        $this->assertTrue($nothing->isNothing());
    }

    public function testIsJust() {
        $just = Maybe::pure("just");
        $nothing = Maybe::pure(null);
        $this->assertTrue($just->isJust());
        $this->assertFalse($nothing->isJust());
    }

    public function testGetJustShouldReturnValueForJust() {
        $just = Maybe::pure("just");
        $this->assertEquals("just", $just->getJust());
    }

    public function testGetJUstShouldThrowExceptionForNothing() {
        $this->setExpectedException('Exception');
        Maybe::pure(null)->getJust();
    }
}
