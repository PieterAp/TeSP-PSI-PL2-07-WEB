<?php

namespace backend\controllers;

use app\models\CategoriaChildSearch;
use app\models\ProdutoSearch;
use common\models\CategoriaChild;
use common\models\Produto;
use Yii;
use common\models\Categoria;
use app\models\CategoriaSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends LayoutController
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
     * Lists all Categoria models.
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $query = (new Query())
            ->select(['categoria.*', 'COUNT(produto.idprodutos) as "qntProdutos"', 'COUNT(DISTINCT categoria_child.idchild) as "qntCategoriasChild"'])
            ->from('Categoria')
            ->leftJoin('categoria_child', '`categoria`.`idcategorias` = `categoria_child`.`categoria_idcategorias`')
            ->leftJoin('produto', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->groupBy('categoria.idcategorias');

        $command = $query->createCommand();
        $allCategories = $command->queryAll();


        $query = (new Query())
            ->select(['categoria_child.*', 'COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('Categoria')
            ->rightJoin('categoria_child', '`categoria`.`idcategorias` = `categoria_child`.`categoria_idcategorias`')
            ->leftJoin('produto', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->groupBy('categoria_child.idchild');

        $command = $query->createCommand();
        $allCategoryChilds = $command->queryAll();


        return $this->render('index', [
            'allCategories' => $allCategories,
            'allCategoryChilds' => $allCategoryChilds,
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * @param $idCategoria
     * @return string
     */
    public function actionIndexproduto($idCategoria)
    {
        $searchModel = new ProdutoSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query
            ->innerJoin('categoria_child', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->innerJoin('categoria', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->where(['categoria.idcategorias' => $idCategoria]);


        return $this->render('//produto/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcategorias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categoria model.
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
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionChangeestado($id)
    {
        $model = $this->findModel($id);

        $modelCategoryChild = new CategoriaChild();
        $allCategoryChilds = $modelCategoryChild->find()->where('categoria_idcategorias = '.$id)->all();

        $modelProduto = new Produto();
        $allProducts = $modelProduto::find()
            ->select('produto.*')
            ->innerJoin('categoria_child', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->innerJoin('categoria', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->where(['categoria.idcategorias' => $id])
            ->all();

        if ($model->categoriaEstado==1)
        {
            $model->categoriaEstado=0;
            foreach ($allCategoryChilds as $eachCategoryChild)
            {
                $eachCategoryChild->childEstado=0;
                $eachCategoryChild->save();
            }
            foreach ($allProducts as $eachProduct)
            {
                $eachProduct->produtoEstado=0;
                $eachProduct->save();
            }
        }
        else
        {
            $model->categoriaEstado=1;
            foreach ($allCategoryChilds as $eachCategoryChild)
            {
                $eachCategoryChild->childEstado=1;
                $eachCategoryChild->save();
            }
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
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
