<?php

namespace frontend\controllers;

use common\models\Categoria;
use common\models\Produto;
use Yii;
use common\models\CategoriaChild;
use app\models\CategoriaChildSearch;
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
        $searchModel = new CategoriaChildSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoriaChild model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        //get category from product ID
        $categoriaSelecionada = Categoria::find()
            ->select('categoria.*')
            ->leftJoin('categoria_child', '`categoria`.`idcategorias` = `categoria_child`.`categoria_idcategorias`')
            ->where(['categoria_child.idchild'=>$id])
            ->one();

        $allProducts = Produto::find()
            ->select('produto.*')
            ->innerJoin('categoria_child', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->where(['categoria_child.idchild' => $id])
            ->all();

        //todo: Improve query above for the following reason: However, a better approach is to exploit the existing relation declarations by calling yii\db\ActiveQuery::joinWith():
        //todo: https://www.yiiframework.com/doc/guide/2.0/en/db-active-record#joining-with-relations

        return $this->render('view', [
            'model' => $this->findModel($id),
            'allProducts' => $allProducts,
            'categoriaSelecionada' => $categoriaSelecionada
        ]);
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
