<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class editAccountCest
{
    protected $formId = '#form-signup';
    protected $formEdit = '#form-edit';
    protected $formLogin = '#login-form';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function everythingSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'cliente001',
            'SignupForm[email]' => 'cliente001@example.com',
            'SignupForm[password]' => '123123',

            'SignupForm[userMorada]' => 'Leiriaaaa',
            'SignupForm[userNomeProprio]' => 'randomguy',
            'SignupForm[userApelido]' => 'rand',
            'SignupForm[userNIF]' => '123111222',
            'SignupForm[userDataNasc]' => '2000-01-01',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'cliente001',
            'email' => 'cliente001@example.com',
        ]);

        /*
        $I->click("//a[contains(@class, 'logot')]");
        $I->see('Log out', 'a');
        $I->click('Log out','a');
        $I->see('Method Not Allowed (#405)', 'h1');
        */



        /*
        $I->submitForm($this->formLogin, [
            'LoginForm[username]' => 'cliente001',
            'LoginForm[password]' => '123123',
        ]);
        $I->see('Sign in', 'a');

        */

        $I->see('Minha conta', 'a');
        $I->click('Minha conta', 'a');

        $I->see('Username', 'label');

        $I->submitForm($this->formEdit, [
            'EditAccountForm[userMorada]' => 'Rua rainha santa idsadsa',
            'EditAccountForm[userDataNasc]' => '1999-02-09',
        ]);

        $I->seeRecord('common\models\UserDATA', [
            'userMorada' => 'Rua rainha santa idsadsa',
            'userDataNasc' => '1999-02-09',
        ]);

    }


}
