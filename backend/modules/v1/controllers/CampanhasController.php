<?php

namespace app\modules\v1\controllers;

use DateTime;
use yii\db\Query;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Campanhas controller for the `v1` module
 */
class CampanhasController extends ActiveController
{
    public $modelClass = 'common\models\Campanha';

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
        $get['routes'][] = array('todas as campanhas disponiveis' => 'campanhas',
                                 'produtos dentro de campanha' => 'campanhas/{id}/produtos');
        $help[] = $get;
        return array($help);
    }

    /**
     * Shows all Campanhas which are visible, in this case by comparing dates
     * @return array
     */
    public function actionAvailable()
    {
        $allCampanhas = (new Query())
            ->select(['campanha.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('campanha')
            ->innerJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->innerJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->andWhere(['produto.produtoEstado'=>1])
            ->all();

        return $allCampanhas;
    }

    /**
     * Shows all Produtos inside of the given $id of Campanha
     * @param $id
     * @return array
     */
    public function actionProdutos($id)
    {
        $allCampanhas = (new Query())
            ->select('produto.*')
            ->from('campanha')
            ->innerJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->innerJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['idCampanha' => $id])
            ->andWhere(['produto.produtoEstado'=>1])
            ->all();

        return $allCampanhas;
    }
}
