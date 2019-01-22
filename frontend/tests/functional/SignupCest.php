<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Sign up', 'h1');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('First name cannot be blank.');
        $I->seeValidationError('Last name cannot be blank.');
        $I->seeValidationError('NIF cannot be blank.');
        $I->seeValidationError('Address cannot be blank.');
        $I->seeValidationError('Birthday cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]'  => 'tester',
            'SignupForm[email]'     => 'ttttt',
            'SignupForm[password]'  => 'tester_password',
        ]
        );
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'cliente001',
            'SignupForm[email]' => 'cliente001@example.com',
            'SignupForm[password]' => '123123',
            'SignupForm[userMorada]' => 'Leiriaaaa',
            'SignupForm[userNomeProprio]' => 'randomguy',
            'SignupForm[userApelido]' => 'rand',
            'SignupForm[userNIF]' => '123111222',
            'SignupForm[userDataNasc]' => '1997-11-02',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'cliente001',
            'email' => 'cliente001@example.com',
        ]);


    }
}
