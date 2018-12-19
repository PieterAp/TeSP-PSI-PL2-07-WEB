<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class LoginCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }
    
    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
