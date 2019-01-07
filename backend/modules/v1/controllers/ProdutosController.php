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
        $Campanha = (new Query())
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

        return $Campanha;
    }
}
