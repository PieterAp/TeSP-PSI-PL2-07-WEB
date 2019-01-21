<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class criarCampanhaCest
{
    protected $formSale = '#form-sales';

    public function Login(FunctionalTester $I)
    {
        //login
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'pedro');
        $I->fillField('LoginForm[password]', 'pedropedro');
        $I->click('login-button');

        $I->see('Pedro Inácio', '.user');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');

        //campanha
        $I->see('All campaigns', 'a');
        $I->click('All campaigns', 'a');
        $I->see('Campanhas', 'h1');
        $I->click('Create Campanha', 'a');
        $I->see('Create Campanha', 'h1');

        $I->submitForm($this->formSale, [
            'CampanhaSales[campanhaNome]' => 'Natal 2019',
            'CampanhaSales[campanhaDataInicio]' => '2019-12-09',
            'CampanhaSales[campanhaDataFim]' => '2019-12-29',
            'CampanhaSales[campanhaDescricao]' => 'Natal for everyone',
        ]);

        $I->seeRecord('common\models\Campanha', [
            'campanhaNome' => 'Natal 2019',
            'campanhaDataInicio' => '2019-12-09',
            'campanhaDataFim' => '2019-12-29',
            'campanhaDescricao' => 'Natal for everyone',

        ]);
    }
}
