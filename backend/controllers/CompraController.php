<?php

namespace backend\controllers;

use common\models\Campanha;
use common\models\Compraproduto;
use common\models\Produto;
use common\models\Produtocampanha;
use Yii;
use common\models\Compra;
use app\models\CompraSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','historic','protudocampanha'],
                'rules' => [
                    [
                        'actions' => ['historic'],
                        'allow' => true,
                        'roles' => ['admin','funcionario'],
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

    /**
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Historico global
     * @return string
     */
    public function actionHistoric()
    {
        $rows = (new Query())
            ->select(['userNomeProprio','userApelido','produto_preco','compraData','produtoNome','produtoMarca'])
            ->from('userdata')
            ->innerJoin('compra','user_iduser=iduser')
            ->innerJoin('compraproduto','compra_idcompras=idcompras')
            ->innerJoin('produto','produto_idprodutos=idprodutos')
            ->where(['compraEstado' => 0]);

        $dataProvider = new ActiveDataProvider(['query' => $rows]);
        return $this->render('historic',[
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compra model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    /*public function actionCreate($id)
    {
        $compra = new Compra();
        $produto = Produto::findOne($id);
        $compra = Compra::find()
            ->andWhere(['user_iduser' => Yii::$app->user->id])
            ->andWhere(['compraEstado'=> 1])
            ->one();

        if($compra == null){
            $compra = new Compra();
            $compra->compraData = date('Y-m-d H:i:s');
            $compra->user_iduser = Yii::$app->user->id;
            $compra->compraValor = $produto->produtoPreco;
        }else{
            $compra->compraData = date('Y-m-d H:i:s');
            $compra->user_iduser = Yii::$app->user->id;
            $compra->compraValor += $produto->produtoPreco;
        }
        $compraproduto = new Compraproduto();

        $compraproduto->compra_idcompras = $compra->idcompras;
        $compraproduto->produto_idprodutos = $id;
        $compra->save();
        $compraproduto->save();
        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
