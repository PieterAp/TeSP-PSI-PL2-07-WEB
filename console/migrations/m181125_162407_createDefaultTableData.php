<?php

use common\models\Campanha;
use common\models\Categoria;
use common\models\CategoriaChild;
use common\models\Compra;
use common\models\Compraproduto;
use common\models\Produto;
use common\models\Produtocampanha;
use common\models\Reparacao;
use yii\db\Migration;
use common\models\User;
use common\models\Userdata;

/**
 * Class m181120_151707_createSpecialUsers
 */
class m181125_162407_createDefaultTableData extends Migration
{
    public function createUser($username,$email,$password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();

        $user->save(false);

        //$idsUser[] = $user->id;
        return $user;
    }

    public function createUserData($user,$nomeproprio,$apelido,$nif,$datanasc,$morada)
    {
        $userdata = new Userdata();
        $userdata->userNomeProprio = $nomeproprio;
        $userdata->userApelido = $apelido;
        $userdata->userNIF = $nif;
        $userdata->userDataNasc = $datanasc;
        $userdata->userMorada = $morada;
        $identity = User::findOne(['username' => $user->username]);
        $userdata->user_id = $identity->id;

        $userdata->save(false);
    }

    public function givePermission ($user,$role)
    {
        //To view available roles view the migration: console/migrations/m181110_211355_init_rbac.php
        //Region: createRole
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole($role);
        $auth->assign($authorRole, $user->getId());
    }


    public function up()
    {
        //region table_user

        //region Role:admin
        //region Username:pieter Role:admin
        $user = $this->createUser('pieter','pieter@gmail.com','pieterpieter');
        $this->createUserData($user,'Pieter','Aparicio','245875326','1997-05-08','Avenida Humberto Delgado, Leiria');
        $this->givePermission($user,'admin');
        //endregion

        //region Username:pedro Role:admin
        $user = $this->createUser('pedro','pedro@gmail.com','pedropedro');
        $this->createUserData($user,'Pedro','Inácio','245875326','1997-09-08','Rua António Frade, Marinha Grande');
        $this->givePermission($user,'admin');
        //endregion
        //endregion

        //region Role:funcionarios
        //region Username:david Role:funcionario
        $user = $this->createUser('david','david@gmail.com','daviddavid');
        $this->createUserData($user,'David','Sousa','245875326','1995-09-08','Rua Humberto Delgado, Lisboa');
        $this->givePermission($user,'funcionario');
        //endregion

        //region Username:tiago Role:funcionario
        $user = $this->createUser('tiago','tiago@gmail.com','tiagotiago');
        $this->createUserData($user,'Tiago','Mendes','245875326','1995-09-08','Rua Humberto Delgado, Lisboa');
        $this->givePermission($user,'funcionario');
        //endregion
        //endregion

        //region Role:clientes
        //region Username:margarida Role:cliente
        $user = $this->createUser('margarida','margarida@gmail.com','margaridamargarida');
        $this->createUserData($user,'Margarida','Isabel','245875326','1997-02-14','Rua Humberto Delgado, Rio Maior');
        $this->givePermission($user,'cliente');
        //endregion

        //region Username:joao Role:cliente
        $user = $this->createUser('joao','joao@gmail.com','joaojoao');
        $this->createUserData($user,'João','Almeida','245875326','1997-09-06','Rua Humberto Delgado, Lisboa');
        $this->givePermission($user,'cliente');
        //endregion
        //endregion

        //endregion


        //region table_campanha
        //region Campanha: Christmas Sales 1
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Christmas Sales';
        $campanha->campanhaDataInicio = '2018-12-01';
        $campanha->campanhaDescricao = 'Products with discount during the Christmas season';
        $campanha->campanhaDataFim = '2018-12-25';
        $campanha->save(false);
        //endregion

        //region Campanha: New Year Sale 2
        $campanha = new Campanha();
        $campanha->campanhaNome = 'New Year Sale';
        $campanha->campanhaDataInicio = '2018-12-31';
        $campanha->campanhaDescricao = 'The stuff you must have during the new year season!';
        $campanha->campanhaDataFim = '2019-01-10';
        $campanha->save(false);
        //endregion

        //region Campanha: New year new stuff 3
        $campanha = new Campanha();
        $campanha->campanhaNome = 'New year new stuff';
        $campanha->campanhaDataInicio = '2019-01-01';
        $campanha->campanhaDescricao = 'New year new opportunities, get them now!';
        $campanha->campanhaDataFim = '2019-01-30';
        $campanha->save(false);
        //endregion

        //region Campanha: Black Weekend 4
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Black Weekend';
        $campanha->campanhaDataInicio = '2018-12-15';
        $campanha->campanhaDescricao = 'Get the stuff you always wantd for the lowest price!';
        $campanha->campanhaDataFim = '2018-12-16';
        $campanha->save(false);
        //endregion

        //region Campanha: Anniversary of FixByte 5
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Anniversary of FixByte';
        $campanha->campanhaDataInicio = '2018-12-01';
        $campanha->campanhaDescricao = 'To celebrate the birth of FixByte!';
        $campanha->campanhaDataFim = '2018-12-31';
        $campanha->save(false);
        //endregion

        //region Campanha: Saldos de Natal 2019 6
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Saldos de Natal 2019';
        $campanha->campanhaDataInicio = '2019-12-01';
        $campanha->campanhaDescricao = 'Produtos em desconto durante a época de natal';
        $campanha->campanhaDataFim = '2019-12-25';
        $campanha->save();
        //endregion

        //region Campanha: Ano novo, preços novos 7
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Ano novo, preços novos';
        $campanha->campanhaDataInicio = '2019-01-01';
        $campanha->campanhaDescricao = 'Ano novo campanha';
        $campanha->campanhaDataFim = '2019-02-25';
        $campanha->save();
        //endregion

        //region Small bonus 8
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Small bonus';
        $campanha->campanhaDataInicio = '2019-01-15';
        $campanha->campanhaDescricao = 'Happy day';
        $campanha->campanhaDataFim = '2019-02-25';
        $campanha->save();
        //endregion
        //region Sales all year 9
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Sales all year';
        $campanha->campanhaDataInicio = '2019-01-02';
        $campanha->campanhaDescricao = 'YEAR';
        $campanha->campanhaDataFim = '2019-12-02';
        $campanha->save();
        //endregion
        //region Pedro birthday 10
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Pedro birthday';
        $campanha->campanhaDataInicio = '2019-02-25';
        $campanha->campanhaDescricao = 'YEAR';
        $campanha->campanhaDataFim = '2019-02-27';
        $campanha->save();
        //endregion
        //endregion


        //region table_categoria
        $categoria = new Categoria();
        $categoria->categoriaNome = 'Components';
        $categoria->categoriaDescricao = 'Usually used to build your own computer';
        $categoria->categoriaEstado = 1;
        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoriaNome = 'Software';
        $categoria->categoriaDescricao = 'To make hardware accessible for humans';
        $categoria->categoriaEstado = 1;
        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoriaNome = 'Storage';
        $categoria->categoriaDescricao = 'To save all of your precious art';
        $categoria->categoriaEstado = 1;
        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoriaNome = 'Network';
        $categoria->categoriaDescricao = 'To connect and share data between two or more computers';
        $categoria->categoriaEstado = 1;
        $categoria->save();
        //endregion


        //region table_categoria_child
        //region Categoria: Components
        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'CPU';
        $categoriaChild->childDescricao = 'Central Processing Unit';
        $categoriaChild->categoria_idcategorias = 1;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();

        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Fans';
        $categoriaChild->childDescricao = 'To cool down your computer';
        $categoriaChild->categoria_idcategorias = 1;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();

        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Motherboards';
        $categoriaChild->childDescricao = 'Usually used to build your own computer';
        $categoriaChild->categoria_idcategorias = 1;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();
        //endregion

        //region Categoria: Software
        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Operating System';
        $categoriaChild->childDescricao = 'To run your software on top of your hardware';
        $categoriaChild->categoria_idcategorias = 2;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();

        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Image Editing';
        $categoriaChild->childDescricao = 'To edit images';
        $categoriaChild->categoria_idcategorias = 2;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();

        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Video Editing';
        $categoriaChild->childDescricao = 'To edit videos';
        $categoriaChild->categoria_idcategorias = 2;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();
        //endregion

        //region Categoria: Storage
        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'USB Sticks';
        $categoriaChild->childDescricao = 'Small and mobile';
        $categoriaChild->categoria_idcategorias = 3;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();

        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Internal';
        $categoriaChild->childDescricao = 'For the inside of you computer';
        $categoriaChild->categoria_idcategorias = 3;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();

        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'External';
        $categoriaChild->childDescricao = 'Same as internal storage but more practical';
        $categoriaChild->categoria_idcategorias = 3;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();
        //endregion

        //region Categoria: Network
        $categoriaChild = new CategoriaChild();
        $categoriaChild->childNome = 'Switch';
        $categoriaChild->childDescricao = 'To manage all the connections';
        $categoriaChild->categoria_idcategorias = 4;
        $categoriaChild->childEstado = 1;
        $categoriaChild->save();
        //endregion
        //endregion


        //region table_produto
        //region Categoria: Components
        //region CategoriaChild: CPU
        $produto = new Produto();
        $produto->produtoNome = 'CPU1';
        $produto->produtoCodigo = 'NA4648464589';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '23';
        $produto->produtoPreco = '200';
        $produto->produtoMarca = 'Intel';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 1;
        $produto->produtoEstado = 1;
        $produto->save(false);

        $produto = new Produto();
        $produto->produtoNome = 'CPU2';
        $produto->produtoCodigo = '457845215';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '33';
        $produto->produtoPreco = '300';
        $produto->produtoMarca = 'Intel';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 1;
        $produto->produtoEstado = 1;
        $produto->save(false);

        $produto = new Produto();
        $produto->produtoNome = 'CPU3';
        $produto->produtoCodigo = '784526985';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '43';
        $produto->produtoPreco = '400';
        $produto->produtoMarca = 'Intel';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 1;
        $produto->produtoEstado = 0;
        $produto->save(false);
        //endregion

        //region CategoriaChild: Fans
        $produto = new Produto();
        $produto->produtoNome = 'FAN1';
        $produto->produtoCodigo = 'T1258478523';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '23';
        $produto->produtoPreco = '200';
        $produto->produtoMarca = 'Cooler Master';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 2;
        $produto->produtoEstado = 1;
        $produto->save(false);

        $produto = new Produto();
        $produto->produtoNome = 'FAN2';
        $produto->produtoCodigo = 'D47758452';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '33';
        $produto->produtoPreco = '300';
        $produto->produtoMarca = 'Cooler Master';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 2;
        $produto->produtoEstado = 0;
        $produto->save(false);

        $produto = new Produto();
        $produto->produtoNome = 'FAN3';
        $produto->produtoCodigo = 'l4475896525';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '43';
        $produto->produtoPreco = '400';
        $produto->produtoMarca = 'Cooler Master';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 2;
        $produto->produtoEstado = 0;
        $produto->save(false);

        //endregion
        //endregion

        //region Categoria: Software
        //region CategoriaChild: Operating System
        $produto = new Produto();
        $produto->produtoNome = 'Windwows 10';
        $produto->produtoCodigo = 'R774582145';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '40';
        $produto->produtoPreco = '700';
        $produto->produtoMarca = 'Microsoft';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 4;
        $produto->produtoEstado = 1;
        $produto->save(false);

        $produto = new Produto();
        $produto->produtoNome = 'Windwows 7';
        $produto->produtoCodigo = 'F5545446566';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '7';
        $produto->produtoPreco = '500';
        $produto->produtoMarca = 'Microsoft';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 4;
        $produto->produtoEstado = 0;
        $produto->save(false);
        //endregion

        //region CategoriaChild: Image Editing
        $produto = new Produto();
        $produto->produtoNome = 'Adobe Photoshop';
        $produto->produtoCodigo = 'k4849646469';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '4';
        $produto->produtoPreco = '40';
        $produto->produtoMarca = 'Adobe';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 5;
        $produto->produtoEstado = 1;
        $produto->save(false);

        $produto = new Produto();
        $produto->produtoNome = 'Adobe Illustrator';
        $produto->produtoCodigo = 'J48646468';
        $produto->produtoDataCriacao = '2019-01-01 00:00:00';
        $produto->produtoStock = '2';
        $produto->produtoPreco = '500';
        $produto->produtoMarca = 'Adobe';
        $produto->produtoDescricao1 = 'Descrição 1';
        $produto->produtoDescricao2 = 'Descrição 2';
        $produto->produtoDescricao3 = 'Descrição 3';
        $produto->produtoDescricao4 = 'Descrição 4';
        $produto->produtoImagem1 = 'image1';
        $produto->categoria_child_id = 5;
        $produto->produtoEstado = 0;
        $produto->save(false);
        //endregion
        //endregion
        //endregion



        //region table_produtocampanha
        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 6;
        $produtocampanha->produtos_idprodutos = 1;
        $produtocampanha->campanhaPercentagem = 5;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 6;
        $produtocampanha->produtos_idprodutos = 2;
        $produtocampanha->campanhaPercentagem = 15;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 6;
        $produtocampanha->produtos_idprodutos = 3;
        $produtocampanha->campanhaPercentagem = 10;


        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 7;
        $produtocampanha->produtos_idprodutos = 4;
        $produtocampanha->campanhaPercentagem = 10;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 7;
        $produtocampanha->produtos_idprodutos = 5;
        $produtocampanha->campanhaPercentagem = 20;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 8;
        $produtocampanha->produtos_idprodutos = 6;
        $produtocampanha->campanhaPercentagem = 8;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 9;
        $produtocampanha->produtos_idprodutos = 7;
        $produtocampanha->campanhaPercentagem = 50;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 10;
        $produtocampanha->produtos_idprodutos = 8;
        $produtocampanha->campanhaPercentagem = 20;

        $produtocampanha = new Produtocampanha();
        $produtocampanha->campanha_idCampanha = 10;
        $produtocampanha->produtos_idprodutos = 9;
        $produtocampanha->campanhaPercentagem = 35;
        //endregion












        //region table_compra

        //endregion


        //region table_compraproduto

        //endregion


        //region table_reparacao

        //endregion
    }

    public function down()
    {
        /*
        echo "m181125_162407_createDefaultTableData cannot be reverted.\n";

        return false;
        */
        $userdata = new Compraproduto();
        $userdata->deleteAll();

        $userdata = new Compra();
        $userdata->deleteAll();

        $userdata = new Produtocampanha();
        $userdata->deleteAll();

        $userdata = new Campanha();
        $userdata->deleteAll();

        $userdata = new Reparacao();
        $userdata->deleteAll();

        $userdata = new Produto();
        $userdata->deleteAll();

        $userdata = new Campanha();
        $userdata->deleteAll();



        $userdata = new Userdata();
        $userdata->deleteAll();

        $user = new User();
        $user->deleteAll();


        echo "Deleted all data!";
    }

}
