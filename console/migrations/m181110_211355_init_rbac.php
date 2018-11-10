<?php

use yii\db\Migration;

/**
 * Class m181110_211355_init_rbac
 */
class m181110_211355_init_rbac extends Migration
{

    public function up()
    {
        $auth = Yii::$app->authManager;

        //Info:
        //Permissions starting with "self", refer to a client only being able to see his own data

        //region createPermission
        //region createPermission Compra
        $createCompra = $auth->createPermission('createCompra');
        $createCompra->description = 'Criar uma compra';
        $auth->add($createCompra);

        $readCompra = $auth->createPermission('readCompra');
        $readCompra->description = 'Visualizar todas as compras';
        $auth->add($readCompra);

        $selfReadCompra = $auth->createPermission('selfreadCompra');
        $selfReadCompra->description = 'Visualizar as proprias compras';
        $auth->add($selfReadCompra);

        $updateCompra = $auth->createPermission('updateCompra');
        $updateCompra->description = 'Editar uma compra';
        $auth->add($updateCompra);

        $deleteCompra = $auth->createPermission('deleteCompra');
        $deleteCompra->description = 'Eliminar um compra';
        $auth->add($deleteCompra);
        //endregion


        //region createPermission Reparacao
        $createReparacao = $auth->createPermission('createReparacao');
        $createReparacao->description = 'Criar uma reparacao';
        $auth->add($createReparacao);

        $readReparacao = $auth->createPermission('readReparacao');
        $readReparacao->description = 'Visualizar todas as reparacoes';
        $auth->add($readReparacao);

        $selfReadReparacao = $auth->createPermission('selfReadReparacao');
        $selfReadReparacao->description = 'Visualizar as proprias reparacoes';
        $auth->add($selfReadReparacao);

        $updateReparacao = $auth->createPermission('updateReparacao');
        $updateReparacao->description = 'Editar uma reparacao';
        $auth->add($updateReparacao);

        $deleteReparacao = $auth->createPermission('deleteReparacao');
        $deleteReparacao->description = 'Eliminar uma reparacao';
        $auth->add($deleteReparacao);
        //endregion


        //region createPermission Cliente
        $createCliente = $auth->createPermission('createCliente');
        $createCliente->description = 'Criar um utilizador';
        $auth->add($createCliente);

        $readCliente = $auth->createPermission('readCliente');
        $readCliente->description = 'Visualizar todos os utilizadores';
        $auth->add($readCliente);

        $selfReadCliente = $auth->createPermission('selfReadCliente');
        $selfReadCliente->description = 'Visualizar a propria conta de utilizador';
        $auth->add($selfReadCliente);

        $updateCliente = $auth->createPermission('updateCliente');
        $updateCliente->description = 'Editar um utilizador';
        $auth->add($updateCliente);

        $selfUpdateCliente = $auth->createPermission('selfUpdateCliente');
        $selfUpdateCliente->description = 'Editar a propria conta de utilizador';
        $auth->add($selfUpdateCliente);

        $deleteCliente = $auth->createPermission('deleteCliente');
        $deleteCliente->description = 'Eliminar um utilizador';
        $auth->add($deleteCliente);
        //endregion


        //region createPermission Produto
        $createProduto = $auth->createPermission('createProduto');
        $createProduto->description = 'Criar um produto';
        $auth->add($createProduto);

        $readProduto = $auth->createPermission('readProduto');
        $readProduto->description = 'Visualizar um produto';
        $auth->add($readProduto);

        $updateProduto = $auth->createPermission('updateProduto');
        $updateProduto->description = 'Editar um produto';
        $auth->add($updateProduto);

        $deleteProduto = $auth->createPermission('deleteProduto');
        $deleteProduto->description = 'Eliminar um produto';
        $auth->add($deleteProduto);
        //endregion


        //region createPermission Campanha
        $createCampanha = $auth->createPermission('createCampanha');
        $createCampanha->description = 'Criar uma campanha';
        $auth->add($createCampanha);

        $readCampanha = $auth->createPermission('readCampanha');
        $readCampanha->description = 'Visualizar uma campanha';
        $auth->add($readCampanha);

        $updateCampanha = $auth->createPermission('updateCampanha');
        $updateCampanha->description = 'Editar uma campanha';
        $auth->add($updateCampanha);

        $deleteCampanha = $auth->createPermission('deleteCampanha');
        $deleteCampanha->description = 'Eliminar uma campanha';
        $auth->add($deleteCampanha);
        //endregion


        //region createPermission Categoria
        $createCategoria = $auth->createPermission('createCategoria');
        $createCategoria->description = 'Criar uma categoria';
        $auth->add($createCategoria);

        $readCategoria = $auth->createPermission('readCategoria');
        $readCategoria->description = 'Visualizar uma categoria';
        $auth->add($readCategoria);

        $updateCategoria = $auth->createPermission('updateCategoria');
        $updateCategoria->description = 'Editar uma categoria';
        $auth->add($updateCategoria);

        $deleteCategoria = $auth->createPermission('deleteCategoria');
        $deleteCategoria->description = 'Eliminar uma categoria';
        $auth->add($deleteCategoria);
        //endregion
        //endregion


        //region createRole
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);

        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        //endregion


        //region addChild (Assign permissions to previously created roles)
        //region addChild $funcionario
        $auth->addChild($funcionario, $createCompra);
        $auth->addChild($funcionario, $readCompra);
        $auth->addChild($funcionario, $updateCompra);

        $auth->addChild($funcionario, $createReparacao);
        $auth->addChild($funcionario, $readReparacao);
        $auth->addChild($funcionario, $updateReparacao);

        $auth->addChild($funcionario, $createCliente);
        $auth->addChild($funcionario, $readCliente);
        $auth->addChild($funcionario, $updateCliente);

        $auth->addChild($funcionario, $createProduto);
        $auth->addChild($funcionario, $readProduto);
        $auth->addChild($funcionario, $updateProduto);

        $auth->addChild($funcionario, $createCampanha);
        $auth->addChild($funcionario, $readCampanha);
        $auth->addChild($funcionario, $updateCampanha);

        $auth->addChild($funcionario, $createCategoria);
        $auth->addChild($funcionario, $readCategoria);
        $auth->addChild($funcionario, $updateCategoria);
        //endregion


        //region addChild $admin
        $auth->addChild($admin, $funcionario); //Inherits permissions from $funcionario
        $auth->addChild($admin, $deleteCompra);
        $auth->addChild($admin, $deleteReparacao);
        $auth->addChild($admin, $deleteCliente);
        $auth->addChild($admin, $deleteProduto);
        $auth->addChild($admin, $deleteCampanha);
        $auth->addChild($admin, $deleteCategoria);
        //endregion


        //region addChild $cliente
        $auth->addChild($cliente, $createCompra);
        $auth->addChild($cliente, $selfReadCompra);

        $auth->addChild($cliente, $createReparacao);
        $auth->addChild($cliente, $selfReadReparacao);

        $auth->addChild($cliente, $createCliente);
        $auth->addChild($cliente, $selfReadCliente);
        $auth->addChild($cliente, $selfUpdateCliente);

        $auth->addChild($cliente, $readProduto);

        $auth->addChild($cliente, $readCampanha);

        $auth->addChild($cliente, $readCategoria);
        //endregion
        //endregion


        //region assignRole (Assign roles to specific users (only users that already exist in the database))
        $auth->assign($admin, 1);
        $auth->assign($funcionario, 2);
        $auth->assign($cliente, 3);
        //endregion
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
