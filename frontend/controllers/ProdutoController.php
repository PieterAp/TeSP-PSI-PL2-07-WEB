<?php

namespace frontend\controllers;

use common\models\Categoria;
use common\models\CategoriaChild;
use Yii;
use common\models\Produto;
use app\models\ProdutoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends LayoutController
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
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Produto();
        $model = Produto::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
        */
        return $this->render('index');
    }

    /**
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndexProducts($idsProdutos)
    {
        //make query to list all the produts that i'm recieving

        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produto model.
     * @param integer $id
     * @return mixed (model,)
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $produtoCategoria = Categoria::find()
            ->select('categoria.*')
            ->leftJoin('categoria_child', '`categoria`.`idcategorias` = `categoria_child`.`categoria_idcategorias`')
            ->leftJoin('produto', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->where(['produto.idprodutos'=>$id])
            ->one();

        $produtoCategoriaChild = CategoriaChild::find()
            ->select('categoria_child.*')
            ->innerJoin('produto','`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->where(['produto.idprodutos'=>$id])
            ->one();


        return $this->render('view', [
            'model' => $this->findModel($id),
            'produtoCategoria' => $produtoCategoria,
            'produtoCategoriaChild' => $produtoCategoriaChild,
        ]);
    }


    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
