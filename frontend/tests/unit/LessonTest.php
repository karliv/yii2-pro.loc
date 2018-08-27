<?php
namespace frontend\tests;

class LessonTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $a = 5;

        $this->assertTrue($a == 5);
        $this->assertEquals(5, $a);
        $this->assertLessThan($a, 3);

        $b = [12, 8, 4, 3];

        $this->assertArrayHasKey(3, $b);
    }
}