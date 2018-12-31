<?php namespace common\tests;

use common\models\Categoria;
use common\models\CategoriaChild;

class categoriachildTest extends \Codeception\Test\Unit
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
        $this->createCategoria();

        $categoriaChild = new CategoriaChild();

        $categoriaChild->setChildNome(null);
        $this->tester->assertFalse($categoriaChild->validate('childNome'));

        $categoriaChild->setChildNome('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($categoriaChild->validate('childNome'));

        $categoriaChild->setChildNome('Single-Board Computers');
        $this->tester->assertTrue($categoriaChild->validate('childNome'));



        $categoriaChild->setChildDescricao('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($categoriaChild->validate('childDescricao'));

        $categoriaChild->setChildDescricao('Small powerful computers');
        $this->tester->assertTrue($categoriaChild->validate('childDescricao'));



        $categoriaChild->setCategoriaIdcategorias(null);
        $this->tester->assertFalse($categoriaChild->validate('categoria_idcategorias'));

        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'DIY', 'categoriaDescricao' => 'Do It Yourself']);
        $categoriaChild->setCategoriaIdcategorias($categoriaGrab->idcategorias);
        $this->tester->assertTrue($categoriaChild->validate('categoria_idcategorias'));



        $categoriaChild->setChildEstado('Smth');
        $this->tester->assertFalse($categoriaChild->validate('childEstado'));

        $categoriaChild->setChildEstado(1);
        $this->tester->assertTrue($categoriaChild->validate('childEstado'));
    }


    /**
     * Creates new CATEGORIACHILD with valid data and saves it
     */
    function testSaveCategoriaChild()
    {
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'DIY', 'categoriaDescricao' => 'Do It Yourself']);

        $categoriaChild = new CategoriaChild();
        $categoriaChild->setChildNome('Single-Board Computers');
        $categoriaChild->setChildDescricao('Small powerful computers');
        $categoriaChild->setCategoriaIdcategorias($categoriaGrab->idcategorias);
        $this->tester->assertTrue($categoriaChild->save());

        $this->assertEquals('Single-Board Computers', $categoriaChild->getChildNome());
        $this->assertEquals(0, $categoriaChild->getChildEstado());
    }

    /**
     * Confirms existence of previously created CATEGORIACHILD
     */
    function testViewSavedCategoriaChild()
    {
        $this->tester->seeRecord('common\models\CategoriaChild',['childNome' => 'Single-Board Computers', 'childDescricao' => 'Small powerful computers', 'childEstado' => 0]);
    }

    /**
     * Updates previously created CATEGORIACHILD with valid data
     */
    function testUpdateCategoriaChild()
    {
        $categoriaChildGrab = $this->tester->grabRecord('common\models\CategoriaChild',['childNome' => 'Single-Board Computers', 'childDescricao' => 'Small powerful computers', 'childEstado' => 0]);

        $categoriaChild = CategoriaChild::findone(['idchild' => $categoriaChildGrab->idchild]);
        $categoriaChild -> childNome= "DIY Components";
        $categoriaChild -> childDescricao = "Components for doing it yourself";
        $categoriaChild -> childEstado = 1;
        $this->assertEquals(1, $categoriaChild->update());
    }

    /**
     * Confirms fields were updated
     */
    function testViewUpdatedCategoriaChild()
    {
        $this->tester->seeRecord('common\models\CategoriaChild',['childNome' => 'DIY Components', 'childDescricao' => 'Components for doing it yourself', 'childEstado' => 1]);
    }

    /**
     * Changes status of CATEGORIACHILD
     */
    function testStatusChangeCategoriaChild()
    {
        $categoriaChildGrab = $this->tester->grabRecord('common\models\CategoriaChild',['childNome' => 'DIY Components', 'childDescricao' => 'Components for doing it yourself', 'childEstado' => 1]);

        $categoriaChild = CategoriaChild::findone(['idchild' => $categoriaChildGrab->idchild]);
        $categoriaChild -> childEstado = 0;
        $this->assertEquals(1, $categoriaChild->update());
    }

    /**
     * Confirms status change
     */
    function viewStatusChangeCategoriaChild()
    {
        $this->tester->seeRecord('common\models\CategoriaChild',['childNome' => 'DIY Components', 'childDescricao' => 'Components for doing it yourself', 'childEstado' => 0]);
    }

    /**
     * Deletes whole CATEGORIACHILD
     */
    function testDeleteCategoriaChild()
    {
        $categoriaChildGrab = $this->tester->grabRecord('common\models\CategoriaChild',['childNome' => 'DIY Components', 'childDescricao' => 'Components for doing it yourself', 'childEstado' => 0]);

        $categoriaChild = CategoriaChild::findone(['idchild' => $categoriaChildGrab->idchild]);
        $this->assertEquals(1, $categoriaChild->delete());

        $this->deleteCategoria();
    }

    /**
     * Confirms that previously deleted CATEGORIACHILD is no longer available
     */
    function testNotSeeCategoriaChild()
    {
        $this->tester->dontSeeRecord('common\models\CategoriaChild',['childNome' => 'DIY Components', 'childDescricao' => 'Components for doing it yourself', 'childEstado' => 0]);
    }




    /**
     * Creates a temporary CATEGORIA to nest the CATEGORIA_CHILD
     */
    public function createCategoria()
    {
        $categoria = new Categoria();
        $categoria->setCategoriaNome('DIY');
        $categoria->setCategoriaDescricao('Do It Yourself');
        $categoria->save();
    }

    /**
     * Deletes the previously created CATEGORIA
     */
    public function deleteCategoria()
    {
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'DIY', 'categoriaDescricao' => 'Do It Yourself']);

        $categoria = Categoria::findOne(['idcategorias' => $categoriaGrab->idcategorias]);
        $categoria->delete();
    }
}