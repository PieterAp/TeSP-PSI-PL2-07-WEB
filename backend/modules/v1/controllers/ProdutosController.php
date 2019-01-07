<?php

namespace app\modules\v1\controllers;

use yii\db\Query;
use yii\rest\ActiveController;

/**
 * Default controller for the `v1` module
 */
class ProdutosController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

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

        $get = array( 'action' => 'get' , 'routes' => array() );
        $get['routes'][] = array('todas as categorias disponiveis' => 'categorias');
        $help[] = $get;

        return array($help);
    }

    /**
     * Shows all Produtos which have a visible status (produtoEstado == 1)
     * @return mixed
     */
    public function actionAvailable()
    {
        $model = new $this->modelClass;
        $allProdutos = $model::find()->where(['produtoEstado'=>1])->all();

        return $allProdutos;
    }

    /**
     * Shows the campanha associated with a certain product
     * @return mixed
     */
    public function actionCampanha($id)
    {
        $Campanhas = (new Query())
            ->select(['campanha.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('campanha')
            ->innerJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->innerJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['produtocampanha.produtos_idprodutos'=>$id])
            ->andWhere(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('`campanha`.`idCampanha`')
            ->all();

        if ($Campanhas!=null)
        {
            foreach($Campanhas as $key=>$oneCampanha)
            {
                $oneCampanha['idCampanha'] = (int) $oneCampanha['idCampanha'];
                $oneCampanha['qntProdutos'] = (int) $oneCampanha['qntProdutos'];

                $Campanhas[$key] = $oneCampanha;
            }
            return $Campanhas;
        }
        return null;
    }

    /**
     * Shows all CATEGORIA's related to the given PRODUTO
     * @return mixed
     */
    public function actionCategoria($id)
    {
        $oneCategoria = (new Query())
            ->select(['categoria.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['produto.idprodutos'=>$id])
            ->andWhere(['categoriaEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('`categoria_child`.`idchild`')
            ->one();

        if($oneCategoria != null)
        {
            $oneCategoria['idcategorias'] = (int) $oneCategoria['idcategorias'];
            $oneCategoria['categoriaEstado'] = (int) $oneCategoria['categoriaEstado'];
            $oneCategoria['qntProdutos'] = (int) $oneCategoria['qntProdutos'];

            return $oneCategoria;
        }
        return null;
    }

    /**
     * Shows all CATEGORIACHILD's related to the given PRODUTO
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionChild($id)
    {
        $oneCategoriesChild = (new Query())
            ->select(['categoria_child.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['produto.idprodutos'=>$id])
            ->andWhere(['childEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->groupBy('`categoria_child`.`idchild`')
            ->one();

        if($oneCategoriesChild != null)
        {
            $oneCategoriesChild['idchild'] = (int) $oneCategoriesChild['idchild'];
            $oneCategoriesChild['categoria_idcategorias'] = (int) $oneCategoriesChild['categoria_idcategorias'];
            $oneCategoriesChild['childEstado'] = (int) $oneCategoriesChild['childEstado'];
            $oneCategoriesChild['qntProdutos'] = (int) $oneCategoriesChild['qntProdutos'];

            return $oneCategoriesChild;
        }
        return null;
    }
}
