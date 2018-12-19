<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    protected $formId = '#form-signup';
    protected $formEdit = '#form-edit';
    protected $formLogin = '#login-form';
    
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/signup'));
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'cliente0011',
            'SignupForm[email]' => 'cliente0011@example.com',
            'SignupForm[password]' => '123123',
            'SignupForm[userMorada]' => 'Leiriaaaa',
            'SignupForm[userNomeProprio]' => 'randomguy',
            'SignupForm[userApelido]' => 'rand',
            'SignupForm[userNIF]' => '123111221',
            'SignupForm[userDataNasc]' => '2000-01-02',
        ]);
        $I->wait(5);
        $I->see('Components');
        $I->click(['id' => 'ola']);

    }
}
