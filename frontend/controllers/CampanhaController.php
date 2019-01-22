<?php

namespace frontend\controllers;

use common\models\Produto;
use common\models\Produtocampanha;
use Yii;
use common\models\Campanha;
use app\models\CampanhaSearch;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
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
    public function actionProdutocampanha($id,$limit){


        $rows = (new Query())
            ->select(['idprodutos','produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) as "precoDpsDesconto"','campanhaPercentagem','produtoNome', 'produtoPreco','produtoImagem1'])
            ->from('campanha')
            ->innerJoin('produtocampanha','campanha_idCampanha=idCampanha')
            ->innerJoin('produto','produtos_idprodutos=idprodutos')
            ->where(['idCampanha' => $id])
            ->limit($limit)
            ->all();

        $count = (new Query())
            ->select(['count(*) as count'])
            ->from('campanha')
            ->innerJoin('produtocampanha','campanha_idCampanha=idCampanha')
            ->innerJoin('produto','produtos_idprodutos=idprodutos')
            ->where(['idCampanha' => $id])
            ->limit($limit)
            ->all();

        $countQuery = $rows;
        $pages = new Pagination(['totalCount' => count($countQuery)]);

        return $this->render('../produto/index',[
            'pages' => $pages,
            'products' => $rows,
            'count' => $count,
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
