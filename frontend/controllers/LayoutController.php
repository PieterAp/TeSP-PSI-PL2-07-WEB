<?php

namespace frontend\controllers;

use common\models\Campanha;
use common\models\Categoria;
use common\models\CategoriaChild;
use common\models\Compra;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: Pieter
 * Date: 20/11/2018
 * Time: 21:49
 */

class LayoutController extends Controller
{
    /**
     * Populates the category navbar in frontend/views/layouts/main.php
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $categorias = Categoria::find()->orderBy("categoriaNome")->where(['categoriaEstado'=>1])->all();
        $categoriasChild = CategoriaChild::find()->orderBy("childNome")->where(['childEstado'=>1])->all();


        $sale = (new Query())
            ->select(['idCampanha','idprodutos','campanhaNome','campanhaDataInicio','campanhaDataFim','campanhaPercentagem','produtoNome'])
            ->from('campanha')
            ->innerJoin('produtocampanha','campanha_idCampanha=idCampanha')
            ->innerJoin('produto','produtos_idprodutos=idprodutos')
            ->where(['>','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<','campanhaDataInicio', date('Y-m-d')])
            ->one();

        $rows = (new Query())
            ->select(['idprodutos','produto_preco','produtoNome','produtoImagem1','produtoImagem2','produtoImagem3','produtoImagem4'])
            ->from('userdata')
            ->innerJoin('compra','user_iduser=iduser')
            ->innerJoin('compraproduto','compra_idcompras=idcompras')
            ->innerJoin('produto','produto_idprodutos=idprodutos')
            ->where(['iduser'=>Yii::$app->user->id, 'compraEstado' => 1]);
        $cart = $rows->all();

        $totalPrice = Compra::find()
            ->select ('compraValor')
            ->where(['>','compraValor', 1])
            ->andWhere(['user_iduser' => Yii::$app->user->id, 'compraEstado'=> 1])
            ->one();

        foreach ($categorias as $keyMain => $categoria)
        {
            $categoriaNavbar[]= ['label' => '' . $categoria->categoriaNome .'', 'url' => Url::to(['categoria/view', 'id' => $categoria->idcategorias]),'id' => $categoria->idcategorias];
        }

        foreach ($categoriasChild as $key => $child)
        {
            $categoriaChildNavbar[]= ['childnome' => '' .  $child->childNome .'', 'childurl' => Url::to(['categoria-child/view', 'id' =>  $child->idchild]),'id' => ''.$child->categoria_idcategorias.''];
        }


        Yii::$app->view->params['categoriaNavbar'] = $categoriaNavbar;
        Yii::$app->view->params['categoriaChildNavbar'] = $categoriaChildNavbar;
        Yii::$app->view->params['sale'] = $sale;
        Yii::$app->view->params['totalPrice'] = $totalPrice;
        Yii::$app->view->params['cart'] = $cart;

        return parent::beforeAction($action);
    }
}
