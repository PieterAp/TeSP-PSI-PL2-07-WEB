<?php

namespace backend\controllers;

use common\models\Produto;
use common\models\Produtocampanha;
use backend\models\CampanhaSales;
use Yii;
use common\models\Campanha;
use app\models\CampanhaSearch;
use yii\data\ActiveDataProvider;
use yii\db\IntegrityException;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampanhaController implements the CRUD actions for Campanha model.
 */
class ProdutocampanhaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'index','view','produtocampanha'],
                        'allow' => true,
                        'roles' => ['admin', 'funcionario'],
                    ],
                    [
                        'actions' => ['delete','update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $rows = (new Query())
            ->select(['idprodutocampanha','idCampanha','idprodutos','campanhaNome','campanhaDataInicio','campanhaDataFim','campanhaDescricao','campanhaPercentagem','produtoNome','campanha_idCampanha'])
            ->from('campanha')
            ->innerJoin('produtocampanha','campanha_idCampanha=idCampanha')
            ->innerJoin('produto','produtos_idprodutos=idprodutos');

        $dataProvider = new ActiveDataProvider(['query' => $rows]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Campanha model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idprodutocampanha)
    {
        $productsale = Produtocampanha::find()
            ->where (['idprodutocampanha' => $idprodutocampanha])
            ->one();

        $sales = Campanha::find()
            ->where (['idCampanha'=> $productsale->campanha_idCampanha])
            ->orderBy('idCampanha')
            ->all();

        $products = Produto::find()
            ->where (['idprodutos'=> $productsale->produtos_idprodutos])
            ->orderBy('idprodutos')
            ->all();

        $listsales = Campanha::find()
            ->select(['idCampanha','campanhaNome'])
            ->where (['>','campanhaDataFim', date('Y-m-d')])
            ->all();
        
        $listproducts = Produto::find()
            ->select(['idprodutos','produtoNome'])
            ->all();

        if ($model = Yii::$app->request->post()) {
            $productsale->produtos_idprodutos = $model['Produto']['idprodutos'];
            $productsale->campanha_idCampanha = $model['Campanha']['idCampanha'];
            $campanhaPercentagem = Yii::$app->request->post('Produtocampanha');
            $productsale->campanhaPercentagem = $campanhaPercentagem;
            $productsale->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'productsale' => $productsale,
            'sales' => $sales,
            'products' => $products,
            'listsales' => $listsales,
            'listproducts' => $listproducts,
        ]);
    }

    /**
     * Deletes an existing Campanha model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (IntegrityException $e) {
            $errors = 1;
            $searchModel = new CampanhaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'errors' => $errors,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->redirect(['index']);
    }
    public function actionProdutocampanha()
    {
        $rows = (new Query())
            ->select(['idCampanha','idprodutos','campanhaNome','campanhaDataInicio','campanhaDataFim','campanhaPercentagem','produtoNome'])
            ->from('campanha')
            ->innerJoin('produtocampanha','campanha_idCampanha=idCampanha')
            ->innerJoin('produto','produtos_idprodutos=idprodutos');
        $dataProvider = new ActiveDataProvider(['query' => $rows]);
        return $this->render('/produtocampanha/index', [
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
        if (($model = Produtocampanha::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
