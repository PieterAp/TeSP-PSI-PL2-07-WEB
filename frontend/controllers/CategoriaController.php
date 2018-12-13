<?php

namespace frontend\controllers;

use Yii;
use common\models\Categoria;
use app\models\CategoriaSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CategoriaChild;
use common\models\Produto;

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
            ->select(['categoria.*', 'COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('Categoria')
            ->leftJoin('categoria_child', '`categoria`.`idcategorias` = `categoria_child`.`categoria_idcategorias`')
            ->leftJoin('produto', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
            ->groupBy('categoria.idcategorias');

        $command = $query->createCommand();
        $categorias = $command->queryAll();

        return $this->render('index', [
            'categorias' => $categorias,
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
        //Group of category childs belonging to the selected category $id
        $allCategoriaChilds = CategoriaChild::find()
                                ->where(['categoria_idcategorias' => $id])
                                ->andWhere(['childEstado' => 1])
                                ->all();


        $allProducts = Produto::find()
        ->select('produto.*')
        ->innerJoin('categoria_child', '`produto`.`categoria_child_id` = `categoria_child`.`idchild`')
        ->innerJoin('categoria', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
        ->where(['categoria.idcategorias' => $id])
        ->andWhere(['produto.produtoEstado' => 1])
        ->all();


        return $this->render('view', [
            'model' => $this->findModel($id),
            'allCategoriaChilds' => $allCategoriaChilds,
            'allProducts' => $allProducts,
        ]);
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
