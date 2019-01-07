<?php

namespace app\modules\v1\controllers;

use common\models\Categoria;
use yii\db\Query;
use yii\rest\ActiveController;

/**
 * Categoriaschild controller for the `v1` module
 */
class CategoriaschildController extends ActiveController
{
    public $modelClass = 'common\models\CategoriaChild';

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
        $get['routes'][] = array('todas as categoriaschild disponiveis' => 'categoriaschild',
                                 'todos os endpoints disponiveis' => 'categoriaschild/help',
                                 'categoriasChild detalhe' => 'categoriaschild/{id}',
                                 'produtos dentro de categoriaschild' => 'categoriaschild/{id}/produtos',
                                 'categoria pertencente à categoriaschild' => 'categoriaschild/{id}/categoria');
        $help[] = $get;

        return array($help);
    }

    /**
     * Shows all CATEGORIASCHILD's which have visible PRODUTO's and which are visible themselves
     * @return mixed
     */
    public function actionAvailable()
    {
        $allCategoriaschild = (new Query())
            ->select(['categoria_child.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria_child')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria_child.childEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('categoria_child.idchild')
            ->all();

        if ($allCategoriaschild!=null)
        {
            foreach($allCategoriaschild as $key=>$oneCategoryChild)
            {
                $oneCategoryChild['idchild'] = (int) $oneCategoryChild['idchild'];
                $oneCategoryChild['categoria_idcategorias'] = (int) $oneCategoryChild['categoria_idcategorias'];
                $oneCategoryChild['childEstado'] = (int) $oneCategoryChild['childEstado'];
                $oneCategoryChild['qntProdutos'] = (int) $oneCategoryChild['qntProdutos'];

                $allCategoriaschild[$key] = $oneCategoryChild;
            }
            return $allCategoriaschild;
        }
        return null;
    }

    /**
     * Shows specific information about one given CATEGORIACHIL
     * @param $id
     * @return array
     */
    public function actionDetail($id)
    {
        $oneCategoryChild = (new Query())
            ->select(['categoria_child.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria_child')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria_child.idchild'=>$id])
            ->andWhere(['categoria_child.childEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('categoria_child.idchild')
            ->one();

        if ($oneCategoryChild!=null)
        {
            $oneCategoryChild['idchild'] = (int) $oneCategoryChild['idchild'];
            $oneCategoryChild['categoria_idcategorias'] = (int) $oneCategoryChild['categoria_idcategorias'];
            $oneCategoryChild['childEstado'] = (int) $oneCategoryChild['childEstado'];
            $oneCategoryChild['qntProdutos'] = (int) $oneCategoryChild['qntProdutos'];

            return $oneCategoryChild;
        }
        return null;
    }


    /**
     * Shows related CATEGORIA of the given $id of CATEGORIACHILD
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionCategoria($id)
    {
        $oneCategory = (new Query())
            ->select(['categoria.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria_child.idchild'=>$id])
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
     * Shows all PRODUTO's inside of the given $id of CATEGORIACHILD
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionProdutos($id)
    {
        $allProducts = (new Query())
            ->select('produto.*')
            ->from('categoria_child')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['idchild' => $id])
            ->all();

        return $allProducts;
    }
}
