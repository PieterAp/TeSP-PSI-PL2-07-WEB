<?php

use common\models\Campanha;
use common\models\Categoria;
use common\models\CategoriaChild;
use common\models\Produto;
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
        //region Campanha: Saldos de natal
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Saldos de Natal';
        $campanha->campanhaDataInicio = '2018-12-01';
        $campanha->campanhaDescricao = 'Produtos em desconto durante a época de natal';
        $campanha->campanhaDataFim = '2018-12-25';
        $campanha->save();
        //endregion

        //region Campanha: Black Weekend
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Black Weekend';
        $campanha->campanhaDataInicio = '2018-12-15';
        $campanha->campanhaDescricao = 'Get the stuff you always wantd for the lowest price!';
        $campanha->campanhaDataFim = '2018-12-16';
        $campanha->save();
        //endregion

        //region Campanha: Anniversary of FixByte
        $campanha = new Campanha();
        $campanha->campanhaNome = 'Anniversary of FixByte';
        $campanha->campanhaDataInicio = '2018-12-01';
        $campanha->campanhaDescricao = 'To celebrate the birth of FixByte!';
        $campanha->campanhaDataFim = '2018-12-31';
        $campanha->save();
        //endregion
        //endregion


        //region table_categoria
        $campanha = new Categoria();
        $campanha->categoriaNome = 'Components';
        $campanha->categoriaDescricao = 'Usually used to build your own computer';
        $campanha->categoriaEstado = 1;
        $campanha->save();

        $campanha = new Categoria();
        $campanha->categoriaNome = 'Software';
        $campanha->categoriaDescricao = 'To make hardware accessible for humans';
        $campanha->categoriaEstado = 1;
        $campanha->save();

        $campanha = new Categoria();
        $campanha->categoriaNome = 'Storage';
        $campanha->categoriaDescricao = 'To save all of your precious art';
        $campanha->categoriaEstado = 1;
        $campanha->save();

        $campanha = new Categoria();
        $campanha->categoriaNome = 'Network';
        $campanha->categoriaDescricao = 'To connect and share data between two or more computers';
        $campanha->categoriaEstado = 1;
        $campanha->save();
        //endregion


        //region table_categoria_child
        //region Categoria: Components
        $campanha = new CategoriaChild();
        $campanha->childNome = 'CPU';
        $campanha->childDescricao = 'Central Processing Unit';
        $campanha->categoria_idcategorias = 1;
        $campanha->childEstado = 1;
        $campanha->save();

        $campanha = new CategoriaChild();
        $campanha->childNome = 'Fans';
        $campanha->childDescricao = 'To cool down your computer';
        $campanha->categoria_idcategorias = 1;
        $campanha->childEstado = 1;
        $campanha->save();

        $campanha = new CategoriaChild();
        $campanha->childNome = 'Motherboards';
        $campanha->childDescricao = 'Usually used to build your own computer';
        $campanha->categoria_idcategorias = 1;
        $campanha->childEstado = 1;
        $campanha->save();
        //endregion

        //region Categoria: Software
        $campanha = new CategoriaChild();
        $campanha->childNome = 'Operating System';
        $campanha->childDescricao = 'To run your software on top of your hardware';
        $campanha->categoria_idcategorias = 2;
        $campanha->childEstado = 1;
        $campanha->save();

        $campanha = new CategoriaChild();
        $campanha->childNome = 'Image Editing';
        $campanha->childDescricao = 'To edit images';
        $campanha->categoria_idcategorias = 2;
        $campanha->childEstado = 1;
        $campanha->save();

        $campanha = new CategoriaChild();
        $campanha->childNome = 'Video Editing';
        $campanha->childDescricao = 'To edit videos';
        $campanha->categoria_idcategorias = 2;
        $campanha->childEstado = 1;
        $campanha->save();
        //endregion

        //region Categoria: Storage
        $campanha = new CategoriaChild();
        $campanha->childNome = 'USB Sticks';
        $campanha->childDescricao = 'Small and mobile';
        $campanha->categoria_idcategorias = 3;
        $campanha->childEstado = 1;
        $campanha->save();

        $campanha = new CategoriaChild();
        $campanha->childNome = 'Internal';
        $campanha->childDescricao = 'For the inside of you computer';
        $campanha->categoria_idcategorias = 3;
        $campanha->childEstado = 1;
        $campanha->save();

        $campanha = new CategoriaChild();
        $campanha->childNome = 'External';
        $campanha->childDescricao = 'Same as internal storage but more practical';
        $campanha->categoria_idcategorias = 3;
        $campanha->childEstado = 1;
        $campanha->save();
        //endregion

        //region Categoria: Network
        $campanha = new CategoriaChild();
        $campanha->childNome = 'Switch';
        $campanha->childDescricao = 'To manage all the connections';
        $campanha->categoria_idcategorias = 4;
        $campanha->childEstado = 1;
        $campanha->save();
        //endregion
        //endregion

/*
        //region table_produto
        //region Categoria: Components
        //region CategoriaChild: CPU
        $campanha = new Produto();
        $campanha->produtoNome = 'CPU';
        $campanha->produtoCodigo = 'Central Processing Unit';
        $campanha->produtoDataCriacao = 'Central Processing Unit';
        $campanha->produtoStock = 'Central Processing Unit';
        $campanha->produtoPreco = 'Central Processing Unit';
        $campanha->produtoMarca = 'Central Processing Unit';
        $campanha->produtoDescricao1 = 'Central Processing Unit';
        $campanha->produtoDescricao2 = 'Central Processing Unit';
        $campanha->produtoDescricao3 = 'Central Processing Unit';
        $campanha->produtoDescricao4 = 'Central Processing Unit';
        $campanha->produtoDescricao5 = 'Central Processing Unit';
        $campanha->produtoDescricao6 = 'Central Processing Unit';
        $campanha->produtoDescricao7 = 'Central Processing Unit';
        $campanha->categoria_child_id = 1;
        $campanha->save();
        //endregion

        //region CategoriaChild: Fans
        $campanha = new Produto();
        $campanha->produtoNome = 'CPU';
        $campanha->produtoCodigo = 'Central Processing Unit';
        $campanha->produtoDataCriacao = 'Central Processing Unit';
        $campanha->produtoStock = 'Central Processing Unit';
        $campanha->produtoPreco = 'Central Processing Unit';
        $campanha->produtoMarca = 'Central Processing Unit';
        $campanha->produtoDescricao1 = 'Central Processing Unit';
        $campanha->produtoDescricao2 = 'Central Processing Unit';
        $campanha->produtoDescricao3 = 'Central Processing Unit';
        $campanha->produtoDescricao4 = 'Central Processing Unit';
        $campanha->produtoDescricao5 = 'Central Processing Unit';
        $campanha->produtoDescricao6 = 'Central Processing Unit';
        $campanha->produtoDescricao7 = 'Central Processing Unit';
        $campanha->categoria_child_id = 1;
        $campanha->save();
        //endregion

        //region CategoriaChild: Motherboards
        $campanha = new Produto();
        $campanha->produtoNome = 'CPU';
        $campanha->produtoCodigo = 'Central Processing Unit';
        $campanha->produtoDataCriacao = 'Central Processing Unit';
        $campanha->produtoStock = 'Central Processing Unit';
        $campanha->produtoPreco = 'Central Processing Unit';
        $campanha->produtoMarca = 'Central Processing Unit';
        $campanha->produtoDescricao1 = 'Central Processing Unit';
        $campanha->produtoDescricao2 = 'Central Processing Unit';
        $campanha->produtoDescricao3 = 'Central Processing Unit';
        $campanha->produtoDescricao4 = 'Central Processing Unit';
        $campanha->produtoDescricao5 = 'Central Processing Unit';
        $campanha->produtoDescricao6 = 'Central Processing Unit';
        $campanha->produtoDescricao7 = 'Central Processing Unit';
        $campanha->categoria_child_id = 1;
        $campanha->save();
        //endregion
        //endregion
        //endregion
*/

        //region table_userdata

        //endregion


        //region table_compra

        //endregion


        //region table_compraproduto

        //endregion


        //region table_produtocampanha

        //endregion


        //region table_reparacao

        //endregion
    }

    public function down()
    {
        echo "m181125_162407_createDefaultTableData cannot be reverted.\n";

        return false;

        /*
        $userdata = new Userdata();
        $userdata->deleteAll('id ='.$this->user_id);

        $user = new User();
        $userdata->deleteAll('id ='.$this->user_id);



        foreach ($this->user_id as $each)
        {
            echo $each;
        }
        echo "Deleted all users!";*/
    }

}
