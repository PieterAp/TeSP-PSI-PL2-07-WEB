<?php

namespace frontend\controllers;

use common\models\Categoria;
use common\models\CategoriaChild;
use Yii;
use common\models\Produto;
use app\models\ProdutoSearch;
use yii\data\Pagination;
use yii\db\Query;
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
    public function actionIndex($categoria=null, $categoriaChild=null, $campanha=null)
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

        $products = new Query;

        $products
            ->select(['produto.*',
                'produtocampanha.campanhaPercentagem',
                'produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"'])
            ->from('produto')
            ->innerJoin('(SELECT categoria_child.*
                              FROM categoria_child
                              '.(($categoriaChild==null) ? '' : ('WHERE idchild='.$categoriaChild)).'
                              ) AS categoria_child ON categoria_child.idchild = produto.categoria_child_id')
            ->innerJoin('(SELECT categoria.*
                              FROM categoria
                              '.(($categoria==null) ? '' : ('WHERE idcategorias='.$categoria)).'
                              ) AS categoria ON categoria.idcategorias = categoria_child.categoria_idcategorias')
            ->leftJoin('(SELECT produtocampanha.*
                              FROM produtocampanha INNER JOIN campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha
                              WHERE (campanha.campanhaDataInicio <= CURRENT_DATE()) AND (campanha.campanhaDataFim >= CURRENT_DATE())
                              ) as produtocampanha ON produto.idprodutos=produtocampanha.produtos_idprodutos')
            ->{($campanha==null) ? 'leftJoin' : 'innerjoin'}('(SELECT campanha.*
                              FROM campanha
                              WHERE (campanha.campanhaDataInicio <= CURRENT_DATE())
                                    AND 
                                    (campanha.campanhaDataFim >= CURRENT_DATE())
                                    '.(($campanha==null) ? '' : ('AND idCampanha='.$campanha)).'
                              ) AS campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha')
        ->where(['produtoEstado'=>1])
            ->groupBy('idprodutos')
            ->orderBy('produtoDataCriacao DESC')
            ->all();

        $products = $products->all();


        $countQuery = $products;
        $pages = new Pagination(['totalCount' => count($countQuery)]);
        $products = new Query;
        $models = $products
            ->select(['produto.*',
                      'produtocampanha.campanhaPercentagem',
                      'produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"'])
            ->from('produto')
            ->innerJoin('(SELECT categoria_child.*
                              FROM categoria_child
                              '.(($categoriaChild==null) ? '' : ('WHERE idchild='.$categoriaChild)).'
                              ) AS categoria_child ON categoria_child.idchild = produto.categoria_child_id')
            ->innerJoin('(SELECT categoria.*
                              FROM categoria
                              '.(($categoria==null) ? '' : ('WHERE idcategorias='.$categoria)).'
                              ) AS categoria ON categoria.idcategorias = categoria_child.categoria_idcategorias')
            ->leftJoin('(SELECT produtocampanha.*
                              FROM produtocampanha INNER JOIN campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha
                              WHERE (campanha.campanhaDataInicio <= CURRENT_DATE()) AND (campanha.campanhaDataFim >= CURRENT_DATE())
                              ) as produtocampanha ON produto.idprodutos=produtocampanha.produtos_idprodutos')
            ->{($campanha==null) ? 'leftJoin' : 'innerjoin'}('(SELECT campanha.*
                              FROM campanha
                              WHERE (campanha.campanhaDataInicio <= CURRENT_DATE())
                                    AND 
                                    (campanha.campanhaDataFim >= CURRENT_DATE())
                                    '.(($campanha==null) ? '' : ('AND idCampanha='.$campanha)).'
                              ) AS campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha')
            ->where(['produtoEstado'=>1])
            ->groupBy('idprodutos')
            ->orderBy('produtoDataCriacao DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $pages->pageSize = 4;

        return $this->render('index', [
            //'categories' => $categories,
            //'subCategories' => $subCategories,
            'products' => $models,
            'pages' => $pages,
        ]);
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

        $products = (new Query())
            ->select(['produto.*',
                'produtocampanha.campanhaPercentagem',
                'produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"',
                'count(compraproduto.produto_idprodutos) as "qntCompras"
                      '])
            ->from('compraproduto')
            ->innerJoin('compra','compra.idcompras = compraproduto.compra_idcompras')
            ->rightJoin('produto', 'compraproduto.produto_idprodutos = produto.idprodutos')
            ->leftJoin('(SELECT produtocampanha.*
                              FROM produtocampanha INNER JOIN campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha
                              WHERE (campanha.campanhaDataInicio <= CURRENT_DATE()) AND (campanha.campanhaDataFim >= CURRENT_DATE())
                              ) as produtocampanha ON produto.idprodutos=produtocampanha.produtos_idprodutos')
            ->leftJoin('(SELECT campanha.*
                              FROM campanha
                              WHERE (campanha.campanhaDataInicio <= CURRENT_DATE()) AND (campanha.campanhaDataFim >= CURRENT_DATE())
                              ) AS campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha')
            ->where(['produtoEstado'=>1])
            ->andWhere(['produto.idprodutos' => $id])
            ->groupBy('produto_idprodutos')
            ->orderBy('(count(compraproduto.produto_idprodutos)) DESC, produtocampanha.campanhaPercentagem DESC')
            ->one();

        return $this->render('view', [
            'model' => $products,
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
