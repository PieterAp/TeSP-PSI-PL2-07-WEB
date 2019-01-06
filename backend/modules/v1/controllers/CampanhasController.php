<?php

namespace app\modules\v1\controllers;

use common\models\Campanha;
use yii\db\Query;
use yii\rest\ActiveController;

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
     * Shows all Campanhas which are visible and which have a valid date (date must be within the limits)
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
            ->groupBy('`campanha`.`idCampanha`')
            ->all();

        foreach($allCampanhas as $key=>$oneCampanha)
        {
            $oneCampanha['idCampanha'] = (int) $oneCampanha['idCampanha'];
            $oneCampanha['qntProdutos'] = (int) $oneCampanha['qntProdutos'];

            $allCampanhas[$key] = $oneCampanha;
        }

        return $allCampanhas;
    }

    /**
     * Shows all Produtos inside of the given $id of Campanha
     * @param $id
     * @return array
     */
    public function actionProdutos($id)
    {
        $allProdutos = (new Query())
            ->select('produto.*,produtocampanha.campanhaPercentagem, produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"')
            ->from('campanha')
            ->innerJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->innerJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['idCampanha' => $id])
            ->andWhere(['produto.produtoEstado'=>1])
            ->all();

        foreach($allProdutos as $key=>$oneProduto)
        {
            $oneProduto['idprodutos'] = (int) $oneProduto['idprodutos'];
            $oneProduto['produtoStock'] = (int) $oneProduto['produtoStock'];
            $oneProduto['produtoPreco'] = (float) $oneProduto['produtoPreco'];
            $oneProduto['categoria_child_id'] = (int) $oneProduto['categoria_child_id'];
            $oneProduto['produtoEstado'] = (int) $oneProduto['produtoEstado'];
            $oneProduto['campanhaPercentagem'] = (int) $oneProduto['campanhaPercentagem'];
            $oneProduto['precoDpsDesconto'] = (float) $oneProduto['precoDpsDesconto'];

            $allProdutos[$key] = $oneProduto;
        }

        return $allProdutos;
    }

    /**
     * Shows specific information about one given CAMPANHA
     * @param $id
     * @return array
     */
    public function actionDetail($id)
    {
        $allCampanhas = Campanha::find()->where(['idCampanha' => $id])->all();

        return $allCampanhas;
    }
}
