<?php

namespace backend\controllers;

use app\models\ProdutoSearch;
use common\models\Categoria;
use common\models\Produto;
use Yii;
use common\models\CategoriaChild;
use app\models\CategoriaChildSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriaChildController implements the CRUD actions for CategoriaChild model.
 */
class CategoriaChildController extends LayoutController
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
                        'actions' => ['index','view','create','update','indexproduto','changeestado'],
                        'allow' => true,
                        'roles' => ['admin','funcionario'],
                    ],
                    [
                        'actions' => ['delete'],
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
     * Lists all CategoriaChild models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['categoria/index']);
    }

    /**
     * Displays a single CategoriaChild model.
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


    public function actionIndexproduto($idCategoriaChild)
    {
        $searchModel = new ProdutoSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query
            ->innerJoin('categoria_child', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->where(['categoria_child.idchild' => $idCategoriaChild]);


        return $this->render('//produto/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new CategoriaChild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {
        $model = new CategoriaChild();

        if ($id==null)
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['categoria/index']);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else
        {
            $categoriaAssociada = Categoria::find()->where(['idcategorias'=>$id])->one();


            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['categoria/index']);
            }

            return $this->render('create', [
                'model' => $model,
                'categoriaAssociada' => $categoriaAssociada,
            ]);
        }
    }

    /**
     * Updates an existing CategoriaChild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['categoria/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoriaChild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionChangeestado($id)
    {
        $model = $this->findModel($id);

        $modelProduto = new Produto();
        $allProducts = $modelProduto::find()
            ->select('produto.*')
            ->where(['categoria_child_id' => $id])
            ->all();

        if ($model->childEstado==1)
        {
            $model->childEstado=0;
            foreach ($allProducts as $eachProduct)
            {
                $eachProduct->produtoEstado=0;
                $eachProduct->save();
            }
        }
        else
        {
            $model->childEstado=1;
            foreach ($allProducts as $eachProduct)
            {
                $eachProduct->produtoEstado=1;
                $eachProduct->save();
            }
        }
        $model->save();

        return $this->redirect(['index']);
    }


    /**
     * Finds the CategoriaChild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoriaChild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoriaChild::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
