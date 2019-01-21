<?php

namespace frontend\controllers;

use common\models\Produto;
use common\models\Produtocampanha;
use Yii;
use common\models\Campanha;
use app\models\CampanhaSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampanhaController implements the CRUD actions for Campanha model.
 */
class CampanhaController extends LayoutController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * produtos dentro de uma campanha ativa
     * @return string
     */
    public function actionProdutocampanha($id){


        $rows = (new Query())
            ->select(['idCampanha','idprodutos','campanhaNome','campanhaDataInicio','campanhaDataFim','campanhaPercentagem','produtoNome'])
            ->from('campanha')
            ->innerJoin('produtocampanha','campanha_idCampanha=idCampanha')
            ->innerJoin('produto','produtos_idprodutos=idprodutos')
            ->where(['idCampanha' => $id]);

        $dataProvider = new ActiveDataProvider(['query' => $rows]);


        return $this->render('../produtocampanha/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Campanha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campanha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campanha::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
