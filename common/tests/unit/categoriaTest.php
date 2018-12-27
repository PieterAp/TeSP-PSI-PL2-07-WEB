<?php namespace common\tests;

use common\models\Categoria;
use yii\db\StaleObjectException;

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


        $categoria->setCategoriaDescricao(null);
        $this->tester->assertTrue($categoria->validate('categoriaDescricao'));

        $categoria->setCategoriaDescricao('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($categoria->validate('categoriaDescricao'));

        $categoria->setCategoriaDescricao('All products gamers want');
        $this->tester->assertTrue($categoria->validate('categoriaDescricao'));
    }

    /**
     * Creates new CATEGORIA with valid data and saves it
     */
    function testSaveCategoria()
    {
        $categoria = new Categoria();
        $categoria->setCategoriaNome('Gaming');
        $categoria->setCategoriaDescricao('All products gamers want');
        $this->tester->assertTrue($categoria->save());

        $this->assertEquals('Gaming', $categoria->getCategoriaNome());
        $this->assertEquals(0, $categoria->getCategoriaEstado());
    }

    /**
     * Confirms existence of previously created CATEGORIA
     */
    function testViewSavedCategoria()
    {
        $this->tester->seeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'All products gamers want', 'categoriaEstado' => 0]);
    }

    /**
     * Updates previously created CATEGORIA with valid data
     */
    function testUpdateCategoria()
    {
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'All products gamers want', 'categoriaEstado' => 0]);

        $categoria = Categoria::findone(['idcategorias' => $categoriaGrab->idcategorias]);
        $categoria -> categoriaDescricao = "Gaming stuff";
        $categoria -> categoriaEstado = 1;
        $this->assertEquals(1, $categoria->update());
        //$categoria->update();
    }

    /**
     * Confirms fields were updated
     */
    function testViewUpdatedCategoria()
    {
        $this->tester->seeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff', 'categoriaEstado' => 1]);
    }

    /**
     * Changes status of CATEGORIA
     */
    function testStatusChangeCategoria()
    {
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff', 'categoriaEstado' => 1]);

        $categoria = Categoria::findone(['idcategorias' => $categoriaGrab->idcategorias]);
        $categoria -> categoriaEstado = 0;
        $this->assertEquals(1, $categoria->update());
        //$categoria->update();
    }

    /**
     * Confirms status change
     */
    function viewStatusChangeCategoria()
    {
        $this->tester->seeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff', 'categoriaEstado' => 0]);
    }

    /**
     * Deletes whole CATEGORIA
     */
    function testDeleteCategoria()
    {
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff', 'categoriaEstado' => 0]);

        $categoria = Categoria::findone(['idcategorias' => $categoriaGrab->idcategorias]);
        $this->assertEquals(1, $categoria->delete());
        //$this->tester->assertTrue($categoria->delete());
    }

    /**
     * Confirms that previously deleted CATEGORIA is no longer available
     */
    function testNotSeeCategoria()
    {
        $this->tester->dontSeeRecord('common\models\Categoria',['categoriaNome' => 'Gaming', 'categoriaDescricao' => 'Gaming stuff', 'categoriaEstado' => 1]);
    }
}