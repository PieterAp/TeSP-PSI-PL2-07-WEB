<?php

namespace app\modules\v1\controllers;

use yii\db\Query;
use yii\rest\ActiveController;

/**
 * Categorias controller for the `v1` module
 */
class CategoriasController extends ActiveController
{
    public $modelClass = 'common\models\Categoria';

    /**
     * Defines actions which are not allowed
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'],//POST
            $actions['update'],//PUT & PATCH {id}
            $actions['delete']);//DELETE {id}

        return $actions;
    }

    /**
     * Shows the user which actions and routes are available to use
     * @return array
     */
    public function actionHelp()
    {
        $help[] = array( 'allowed actions' => 'get');

        $get = array( 'action' => 'get', 'access' => 'unrestricted', 'routes' => array() );
        $get['routes'][] = array('todas as categorias disponiveis' => 'categorias',
                                 'todos os endpoints disponiveis' => 'categorias/help',
                                 'categorias detalhe' => 'categorias/{id}',
                                 'produtos dentro de categoria' => 'categorias/{id}/produtos',
                                 'categorias child dentro de categoria' => 'categorias/{id}/child');
        $help[] = $get;

        return array($help);
    }

    /**
     * Shows all CATEGORIA's which have visible PRODUTO's and which are visible themselves
     * @return mixed
     */
    public function actionAvailable()
    {
        $allCategories = (new Query())
            ->select(['categoria.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->rightJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->leftJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoriaEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('`categoria`.`idcategorias`')
            ->all();

        if ($allCategories!=null)
        {
            foreach($allCategories as $key=>$oneCategory)
            {
                $oneCategory['idcategorias'] = (int) $oneCategory['idcategorias'];
                $oneCategory['categoriaEstado'] = (int) $oneCategory['categoriaEstado'];
                $oneCategory['qntProdutos'] = (int) $oneCategory['qntProdutos'];

                $allCategories[$key] = $oneCategory;
            }
            return $allCategories;
        }
        return null;
    }

    /**
     * Shows specific information about one given CATEGORIA
     * @param $id
     * @return array
     */
    public function actionDetail($id)
    {
        $oneCategory = (new Query())
            ->select(['categoria.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria.idcategorias'=>$id])
            ->andWhere(['categoriaEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->one();

        if ($oneCategory!=null)
        {
            $oneCategory['idcategorias'] = (int) $oneCategory['idcategorias'];
            $oneCategory['categoriaEstado'] = (int) $oneCategory['categoriaEstado'];
            $oneCategory['qntProdutos'] = (int) $oneCategory['qntProdutos'];
            return $oneCategory;
        }
        return null;
    }

    /**
     * Shows all PRODUTO's inside of the given $id of CATEGORIA
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionProdutos($id)
    {
        $allProdutos = (new Query())
            ->select(['produto.*'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria.idcategorias' => $id])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('`produto`.`idprodutos`')
            ->all();

        if ($allProdutos!=null)
        {
            foreach($allProdutos as $key=>$oneProduto)
            {
                $oneProduto['idprodutos'] = (int) $oneProduto['idprodutos'];
                $oneProduto['produtoStock'] = (int) $oneProduto['produtoStock'];
                $oneProduto['produtoPreco'] = (float) $oneProduto['produtoPreco'];
                $oneProduto['categoria_child_id'] = (int) $oneProduto['categoria_child_id'];
                $oneProduto['produtoEstado'] = (int) $oneProduto['produtoEstado'];

                $allProdutos[$key] = $oneProduto;
            }
            return $allProdutos;
        }
        return null;
    }

    /**
     * Shows all CATEGORIACHILD's inside of the given $id of CATEGORIA
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionChild($id)
    {
        $allCategoriesChild = (new Query())
            ->select(['categoria_child.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria_child.categoria_idcategorias'=>$id])
            ->andWhere(['categoriaEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('`categoria_child`.`idchild`')
            ->all();


        if ($allCategoriesChild!=null)
        {
            foreach($allCategoriesChild as $key=>$oneCategoryChild)
            {
                $oneCategoryChild['idchild'] = (int) $oneCategoryChild['idchild'];
                $oneCategoryChild['categoria_idcategorias'] = (int) $oneCategoryChild['categoria_idcategorias'];
                $oneCategoryChild['childEstado'] = (int) $oneCategoryChild['childEstado'];
                $oneCategoryChild['qntProdutos'] = (int) $oneCategoryChild['qntProdutos'];

                $allCategoriesChild[$key] = $oneCategoryChild;
            }
            return $allCategoriesChild;
        }
        return null;
    }
}
