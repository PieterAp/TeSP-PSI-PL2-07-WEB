<?php namespace common\tests;

use common\models\Categoria;
use common\models\CategoriaChild;
use common\models\Produto;

class produtoTest extends \Codeception\Test\Unit
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
        $this->createCategoriaChild();

        $produto = new Produto();

        $produto->setProdutoNome(null);
        $this->tester->assertFalse($produto->validate('produtoNome'));

        $produto->setProdutoNome('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($produto->validate('produtoNome'));

        $produto->setProdutoNome('Raspberry Pi3 B');
        $this->tester->assertTrue($produto->validate('produtoNome'));



        $produto->setProdutoCodigo(null);
        $this->tester->assertFalse($produto->validate('produtoCodigo'));

        $produto->setProdutoCodigo('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($produto->validate('produtoCodigo'));

        $produto->setProdutoCodigo('27N8896PL7');
        $this->tester->assertTrue($produto->validate('produtoCodigo'));



        $produto->setProdutoDataCriacao(null);
        $this->tester->assertFalse($produto->validate('produtoDataCriacao'));

        $produto->setProdutoDataCriacao('ninja date');
        $this->tester->assertFalse($produto->validate('produtoDataCriacao'));

        $produto->setProdutoDataCriacao('30-12-2018 06:05');
        $this->tester->assertFalse($produto->validate('produtoDataCriacao'));

        $produto->setProdutoDataCriacao('2018-12-30 06:05:28');
        $this->tester->assertTrue($produto->validate('produtoDataCriacao'));



        $produto->setProdutoStock(null);
        $this->tester->assertFalse($produto->validate('produtoStock'));

        $produto->setProdutoStock('twenty-seven');
        $this->tester->assertFalse($produto->validate('produtoStock'));

        $produto->setProdutoStock(20.25);
        $this->tester->assertFalse($produto->validate('produtoStock'));

        $produto->setProdutoStock(27);
        $this->tester->assertTrue($produto->validate('produtoStock'));



        $produto->setProdutoPreco(null);
        $this->tester->assertFalse($produto->validate('produtoPreco'));

        $produto->setProdutoPreco('twenty');
        $this->tester->assertFalse($produto->validate('produtoPreco'));

        $produto->setProdutoPreco(20.25);
        $this->tester->assertTrue($produto->validate('produtoPreco'));

        $produto->setProdutoPreco(20);
        $this->tester->assertTrue($produto->validate('produtoPreco'));



        $produto->setProdutoMarca(null);
        $this->tester->assertFalse($produto->validate('produtoMarca'));

        $produto->setProdutoMarca('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($produto->validate('produtoMarca'));

        $produto->setProdutoMarca('HP');
        $this->tester->assertTrue($produto->validate('produtoMarca'));



        $produto->setProdutoDescricao1('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($produto->validate('produtoDescricao1'));

        $produto->setProdutoDescricao1('RAM: 1GB RAM');
        $this->tester->assertTrue($produto->validate('produtoDescricao1'));


        $produto->setProdutoDescricao2('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($produto->validate('produtoDescricao2'));

        $produto->setProdutoDescricao2('USB: 4x USB2 ports');
        $this->tester->assertTrue($produto->validate('produtoDescricao2'));


        /*
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'DIY', 'categoriaDescricao' => 'Do It Yourself']);
        $categoriaChild->setCategoriaIdcategorias($categoriaGrab->idcategorias);
        $this->tester->assertTrue($categoriaChild->validate('categoria_idcategorias'));
        */
    }

    /**
     * Creates new PRODUTO with valid data and saves it
     */
    function testSaveProduto()
    {
        $produto = new Produto();
        $produto->setProdutoNome('Raspberry Pi3 B');
        $produto->setProdutoCodigo('27N8896PL7');
        $produto->setProdutoDataCriacao(date("Y-m-d H:i:s"));
        $produto->setProdutoStock(27);
        $produto->setProdutoPreco(20.25);
        $produto->setProdutoMarca('Raspberry Pi Foundation');

        $produto->setProdutoDescricao1('CPU: Quad Core 1.2GHz Broadcom BCM2837 64bit');
        $produto->setProdutoDescricao2('RAM: 1GB RAM');
        $produto->setProdutoDescricao3('Wireless & Bluetooth: BCM43438 Low Energy (BLE) on board');
        $produto->setProdutoDescricao4('GPIO ports: 40-pin extended GPIO');
        $produto->setProdutoDescricao5('USB: 4x USB2 ports');
        $produto->setProdutoDescricao6('Hard Disk: n/a');
        $produto->setProdutoDescricao7('Video Connectivity: Full size HDMI');

        $categoriaChild = $this->tester->grabRecord('common\models\CategoriaChild',['childNome' => 'Single-Board Computers', 'childDescricao' => 'Small powerful computers']);
        $categoriaChild = CategoriaChild::findOne(['idchild' => $categoriaChild->idchild]);
        $produto->setCategoriaChildId($categoriaChild->idchild);

        $produto->setProdutoImagem1('');
        $produto->setProdutoImagem2('');
        $produto->setProdutoImagem3('');
        $produto->setProdutoImagem4('');

        $this->tester->assertTrue($produto->save());

        $this->assertEquals('27N8896PL7', $produto->getProdutoCodigo());
        $this->assertEquals(1, $produto->getProdutoEstado());
    }

    /**
     * Confirms existence of previously created PRODUTO
     */
    function testViewSavedProduto()
    {
        $this->tester->seeRecord('common\models\Produto',['produtoNome' => 'Raspberry Pi3 B','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 1]);
    }

    /**
     * Updates previously created PRODUTO with valid data
     */
    function testUpdateProduto()
    {
        $produtoGrab = $this->tester->grabRecord('common\models\Produto',['produtoNome' => 'Raspberry Pi3 B','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 1]);

        $produto = Produto::findone(['idprodutos' => $produtoGrab->idprodutos]);
        $produto -> produtoDescricao8 ='Micro SD port for loading your operating system and storing data';
        $produto -> produtoEstado = 0;
        $this->assertEquals(1, $produto->update());
    }

    /**
     * Confirms fields were updated
     */
    function testViewUpdatedProduto()
    {
        $this->tester->seeRecord('common\models\Produto',['produtoDescricao8' => 'Micro SD port for loading your operating system and storing data','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 0]);
    }

    /**
     * Changes status of PRODUTO
     */
    function testStatusChangeProduto()
    {
        $produtoGrab = $this->tester->grabRecord('common\models\Produto',['produtoNome' => 'Raspberry Pi3 B','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 0]);

        $produto = Produto::findone(['idprodutos' => $produtoGrab->idprodutos]);
        $produto -> produtoEstado = 1;
        $this->assertEquals(1, $produto->update());
    }

    /**
     * Confirms status change
     */
    function viewStatusChangeProduto()
    {
        $this->tester->seeRecord('common\models\Produto',['produtoNome' => 'Raspberry Pi3 B','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 1]);
    }

    /**
     * Deletes whole PRODUTO
     */
    function testDeleteProduto()
    {
        $produtoGrab = $this->tester->grabRecord('common\models\Produto',['produtoNome' => 'Raspberry Pi3 B','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 1]);

        $produto = Produto::findone(['idprodutos' => $produtoGrab->idprodutos]);
        $this->assertEquals(1, $produto->delete());

        $this->deleteCategoriaChild();
        $this->deleteCategoria();
    }

    /**
     * Confirms that previously deleted PRODUTO is no longer available
     */
    function testNotSeeProduto()
    {
        $this->tester->dontSeeRecord('common\models\Produto',['produtoNome' => 'Raspberry Pi3 B','produtoCodigo' => '27N8896PL7', 'produtoEstado' => 1]);
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

    /**
     * Creates a temporary CATEGORIA_CHILD to nest PRODUTO
     */
    public function createCategoriaChild()
    {
        $categoriaGrab = $this->tester->grabRecord('common\models\Categoria',['categoriaNome' => 'DIY', 'categoriaDescricao' => 'Do It Yourself']);
        $categoria = Categoria::findOne(['idcategorias' => $categoriaGrab->idcategorias]);

        $categoriaChild = new CategoriaChild();
        $categoriaChild->setChildNome('Single-Board Computers');
        $categoriaChild->setChildDescricao('Small powerful computers');
        $categoriaChild->setCategoriaIdcategorias($categoria->idcategorias);
        $categoriaChild->save();
    }

    /**
     * Deletes the previously created CATEGORIA_CHILD
     */
    public function deleteCategoriaChild()
    {
        $categoriaChild = $this->tester->grabRecord('common\models\CategoriaChild',['childNome' => 'Single-Board Computers', 'childDescricao' => 'Small powerful computers']);

        $categoriaChild = CategoriaChild::findOne(['idchild' => $categoriaChild->idchild]);
        $categoriaChild->delete();
    }
}