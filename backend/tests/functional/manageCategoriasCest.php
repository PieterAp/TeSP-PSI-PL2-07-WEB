<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class manageCategoriasCest
{
    protected $formCategory = '#form-category';

    public function manageCategorias(FunctionalTester $I)
    {
        //Login into backend in order to manage CATEGORIA
        codecept_debug("\n\n .::Login::. \n");

        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'pieter');
        $I->fillField('LoginForm[password]', 'pieterpieter');

        $I->click('login-button');
        $I->see('Pieter Aparicio', '.user');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');


        //Creates new CATEGORIA
        codecept_debug("\n\n .::Create CATEGORIA::. \n");
        $I->amOnPage('/site/index');
        $I->see('Categories', 'span');
        $I->click('Categories', 'a');
        $I->see('Categories', 'h1');
        $I->click('Create Category', 'a');
        $I->see('Create Category', 'h1');

        $I->submitForm('#form-category', []);
        $I->expectTo('see validations errors');
        $I->see('Name', 'label');
        $I->see('Name cannot be blank');

        $I->submitForm($this->formCategory, [
            'Categoria[categoriaNome]' => 'DIY',
            'Categoria[categoriaDescricao]' => 'Do it yourself',
        ]);

        $I->seeRecord('common\models\Categoria', [
            'categoriaNome' => 'DIY',
            'categoriaDescricao' => 'Do it yourself',
            'categoriaEstado' => 0,
        ]);


        //Edits previously created CATEGORIA
        codecept_debug("\n\n .::Edit CATEGORIA::. \n");
        $I->amOnPage('/categoria/index');
        $I->see('DIY', 'strong');
        $I->see('Edit', '#editDIY');
        $I->click('Edit', '#editDIY');
        $I->see('Update Category: DIY', 'h1');

        $I->submitForm($this->formCategory, [
            'Categoria[categoriaNome]' => 'Gaming',
            'Categoria[categoriaDescricao]' => 'Gaming Products',
        ]);

        $I->seeRecord('common\models\Categoria', [
            'categoriaNome' => 'Gaming',
            'categoriaDescricao' => 'Gaming Products',
            'categoriaEstado' => 0,
        ]);

        $I->amOnPage('/categoria/index');
        $I->see('Categories', 'h1');
        $I->see('Gaming', 'strong');


        //Hides CATEGORIA
        codecept_debug("\n\n .::Hide CATEGORIA::. \n");
        $I->amOnPage('/categoria/index');
        $I->see('Categories', 'h1');
        $I->see('Gaming', 'strong');
        $I->see('Unhide Cat', '#hideGaming');
        $I->click('Unhide Cat', '#hideGaming');

        $I->seeRecord('common\models\Categoria', [
            'categoriaNome' => 'Gaming',
            'categoriaDescricao' => 'Gaming Products',
            'categoriaEstado' => 1,
        ]);

        $I->amOnPage('/categoria/index');
        $I->see('Categories', 'h1');
        $I->see('Gaming', 'strong');
        $I->see('Hide Cat', '#hideGaming');
        $I->click('Hide Cat', '#hideGaming');


        //Deletes CATEGORIA
        /*
        codecept_debug("\n\n .::Delete CATEGORIA::. \n");
        $I->amOnPage('/categoria/index');
        $I->see('Categories', 'h1');
        $I->see('Gaming', 'strong');
        $I->see('Delete', '#deleteGaming');
        $I->click('Delete', '#deleteGaming');

        $I->dontSeeRecord('common\models\Categoria', [
            'categoriaNome' => 'Gaming',
            'categoriaDescricao' => 'Gaming Products',
            'categoriaEstado' => 0,
        ]);

        $I->amOnPage('/site/index');
        $I->see('Categories', 'h2');
        $I->click('Manage', 'a');
        $I->see('Categories', 'h1');
        $I->dontSee('Gaming', 'strong');
        */
    }
}
