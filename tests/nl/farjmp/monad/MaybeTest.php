<?php

namespace nl\farjmp\monad;

class MaybeTest extends \PHPUnit_Framework_TestCase
{
    public function testMaybeNullShouldNotBind() {
        $testCase = $this;
        Maybe::pure(null)->bind(function($value) use (&$testCase) {
            $testCase->assertTrue(false);
        });
    }

    public function testMaybeSomethingShouldBind() {
        $testValue = "something";
        $testCase = $this;
        Maybe::pure($testValue)->bind(function($value) use (&$testCase, &$testValue) {
            $testCase->assertEquals($testValue, $value);
        });
    }
}
