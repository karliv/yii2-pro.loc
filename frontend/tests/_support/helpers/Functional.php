<?php

namespace frontend\tests\helpers;


use Codeception\Module;

class Functional extends Module
{
    public function equals($value, $expected, $message= '')
    {
        $this->assertEquals($value, $expected, $message);
    }
}