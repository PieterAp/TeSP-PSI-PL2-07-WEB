<?php namespace common\tests;

use common\models\Categoria;

class categoriaTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {

    }

    protected function _after()
    {

    }

    /**
     * Validates model rules
     */
    public function testValidation()
    {
        $categoria = new Categoria();

        $categoria->setCategoriaNome(null);
        $this->tester->assertFalse($categoria->validate('categoriaNome'));

        $categoria->setCategoriaNome('A');
        $this->tester->assertFalse($categoria->validate('categoriaNome'));

        $categoria->setCategoriaNome('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($categoria->validate('categoriaNome'));

        $categoria->setCategoriaNome('Gaming');
        $this->tester->assertTrue($categoria->validate('categoriaNome'));


        $categoria->setCategoriaDescricao('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($categoria->validate('categoriaDescricao'));

        $categoria->setCategoriaDescricao('Gaming');
        $this->tester->assertTrue($categoria->validate('categoriaDescricao'));
    }

    /**
     * Tests save function in CATEGORIA model with correct data
     */
    function testSaveCategoria()
    {
        $categoria = new Categoria();
        $categoria->setCategoriaNome('Gaming');
        $categoria->setCategoriaDescricao('Category that manages gaming articles');
        $categoria->save();

        $this->assertEquals('Gaming', $categoria->getCategoriaNome());
    }

    /**
     * Tests model to see if previously created CATEGORIA is present
     */
    function testViewSavedCategoria()
    {
        $this->tester->seeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Category that manages gaming articles']);
    }

    /**
     * Tests update function in CATEGORIA model with correct data
     */
    function testUpdateCategoria()
    {
        $id = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Category that manages gaming articles']);

        $categoria = Categoria::findOne($id);
        $categoria -> CategoriaDescricao = "Gaming stuff";
        $categoria->update();
    }

    /**
     * Tests model to see if previously updated CATEGORIA has been changed
     */
    function testViewUpdatedCategoria()
    {
        $this->tester->seeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff']);
    }

    /**
     * Tests delete function in CATEGORIA model
     */
    function testDeleteCategoria()
    {
        $id = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff']);

        $categoria = Categoria::findOne($id);
        $categoria->delete();
    }

    /**
     * Tests model to see if previously deleted CATEGORIA does not exist
     */
    function testNotSeeCategoria()
    {
        $this->tester->dontSeeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff']);
    }
}