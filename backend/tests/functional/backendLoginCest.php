<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class backendLoginCest
{
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Username', 'pedroa');
        $I->fillField('Password', '123123');
        $I->click('login-button');

        $I->see('Logout (pedroa)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}