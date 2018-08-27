<?php
namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class FirstCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    /**
     * @param FunctionalTester $I
     * @example(url="/", h1="Congratulations")
     * @example(url="site/about", h1="About")
     * @example(url="site/contact", h1="Contact")
     */
    public function tryToTest(FunctionalTester $I, \Codeception\Example $data)
    {
        $I->amOnPage($data['url']);
        $I->see($data['h1'], 'h1');

        //$I->amOnPage('/');
        //$I->see('Heading', 'h2');
        //$I->dontSee('error');
    }
}
