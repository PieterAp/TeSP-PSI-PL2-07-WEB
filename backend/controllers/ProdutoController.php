<?php

namespace backend\controllers;

use common\models\Campanha;
use common\models\Produtocampanha;
use Yii;
use common\models\Produto;
use app\models\ProdutoSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
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
                        'actions' => ['produtocampanha','index'],
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

    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionProdutocampanha($id)
    {
        $productsale = new Produtocampanha();
        $sales = Campanha::find()
            ->where (['>','campanhaDataInicio', date('Y-m-d')])
            ->orderBy('idCampanha')
            ->all();
        $sale  = ArrayHelper::map($sales,'idCampanha','campanhaNome');

        if (Yii::$app->request->post()) {
            $productsale = Yii::$app->request->post('Produtocampanha');
            $sale = Yii::$app->request->post('Campanha');


            $productSale = new Produtocampanha();
            $productSale->produtos_idprodutos = $id;
            $productSale->campanha_idCampanha = $sale['campanhaNome'];
            $productSale->campanhaPercentagem = $productsale['campanhaPercentagem'];

            $productSale->save(false);

            return $this->redirect(['index']);
        }
        return $this->render('produtocampanha', [
            'productsale' => $productsale,
            'sale' => $sale,
            'sales' => $sales,
        ]);

    }
    public function actionIndex()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Produto();
        $model = Produto::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Produto model.
     * @param integer $idprodutos
     * @param integer $categoria_idcategorias
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idprodutos, $categoria_idcategorias)
    {
        return $this->render('view', [
            'model' => $this->findModel($idprodutos, $categoria_idcategorias),
        ]);
    }

    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idprodutos' => $model->idprodutos, 'categoria_idcategorias' => $model->categoria_idcategorias]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idprodutos
     * @param integer $categoria_idcategorias
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idprodutos, $categoria_idcategorias)
    {
        $model = $this->findModel($idprodutos, $categoria_idcategorias);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idprodutos' => $model->idprodutos, 'categoria_idcategorias' => $model->categoria_idcategorias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idprodutos
     * @param integer $categoria_idcategorias
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idprodutos, $categoria_idcategorias)
    {
        $this->findModel($idprodutos, $categoria_idcategorias)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idprodutos
     * @param integer $categoria_idcategorias
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idprodutos, $categoria_idcategorias)
    {
        if (($model = Produto::findOne(['idprodutos' => $idprodutos, 'categoria_idcategorias' => $categoria_idcategorias])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
