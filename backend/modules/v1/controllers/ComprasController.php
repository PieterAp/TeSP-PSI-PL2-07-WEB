<?php

namespace app\modules\v1\controllers;

use common\models\Compra;
use common\models\Compraproduto;
use common\models\Produto;
use common\models\User;
use Yii;
use yii\db\Query;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Compras controller for the `v1` module
 */
class ComprasController extends ActiveController
{
    public $modelClass = 'common\models\Compra';
    /**
     * API Authorization - Query Parameter Authentication
     */
    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['help','setcompras','getcompras'],
        ];
        return $behaviors;
    }

    /**
     * Shows all COMPRAS
     */
    public function actionGetcompras($accesstoken)
    {
        $user = User::findIdentityByAccessToken($accesstoken);
        if ($user == null or empty($user)){
            return false;
        }

        $cart = (new Query())
            ->select(['idprodutos','produto_preco','produtoNome','produtoImagem1','produtoImagem2','produtoImagem3','produtoImagem4'])
            ->from('userdata')
            ->innerJoin('compra','user_iduser=iduser')
            ->innerJoin('compraproduto','compra_idcompras=idcompras')
            ->innerJoin('produto','produto_idprodutos=idprodutos')
            ->where(['iduser'=>$user->id, 'compraEstado' => 1])
            ->all();

        return $cart;
    }

    /**
     * Shows all COMPRAS
     */
    public function actionSetcompras()
    {
        $user = User::findIdentityByAccessToken(Yii::$app->request->getBodyParam('accesstoken'));

        if ($user == null){
            return false;
        }

        $produto = Produto::findOne(Yii::$app->request->getBodyParam('idproduto'));

        if ($produto == NULL){
            return 'id not found';
        }

        $id = (new Query())
            ->select(['produto.*',
                'produtocampanha.campanhaPercentagem',
                'produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"'])
            ->from('campanha')
            ->leftJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->leftJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->andWhere(['produto.produtoEstado'=>1])
            ->andWhere(['idprodutos' => Yii::$app->request->getBodyParam('idproduto')])
            ->groupBy('idCampanha')
            ->orderBy("campanhaDataFim, produtoDataCriacao DESC")
            ->limit(8)
            ->one();

        $compra = Compra::find()
            ->where(['user_iduser' => $user->id, 'compraEstado'=> 1])
            ->one();

        if ($produto->produtoStock > 0){
            if($compra == null){  //se nao existir CART, CRIA
                $compra = new Compra();
                $compra->compraData = date('Y-m-d H:i:s');
                $compra->user_iduser = $user->id;
                if ($id != null or $id != false){ //SE O PRODUTO TIVER EM CAMPANHA METE O PREÇO DA CAMPANHa
                    $compra->compraValor = $id['precoDpsDesconto'];
                    $compra->save();
                    $produto->save(false);
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $id['precoDpsDesconto'];
                }else{
                    $compra->compraValor = $produto->produtoPreco;
                    $compra->save();
                    $produto->save(false);
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $produto->produtoPreco;
                }
                $compraproduto->compra_idcompras = $compra->idcompras;
                $compraproduto->produto_idprodutos = Yii::$app->request->getBodyParam('idproduto');
                $produto->produtoStock = $produto->produtoStock -1;
                $produto->save(false);
                $compraproduto->save(false);
            }else{ // se existir CART adiciona ao CART
                $compra->compraData = date('Y-m-d H:i:s');
                $compra->user_iduser = $user->id;
                if ($id != null or $id != false){ //SE O PRODUTO TIVER EM CAMPANHA METE O PREÇO DA CAMPANHA
                    $compra->compraValor += $id['precoDpsDesconto'];
                    $compra->save();
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $id['precoDpsDesconto'];
                }else{
                    $compra->compraValor += $produto->produtoPreco;
                    $compra->save();
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $produto->produtoPreco;
                }
                $compraproduto->compra_idcompras = $compra->idcompras;
                $compraproduto->produto_idprodutos = Yii::$app->request->getBodyParam('idproduto');
                $produto->produtoStock = $produto->produtoStock -1;
                $produto->save(false);
                $compraproduto->save(false);
            }
        }else {
            return 'no stock';
        }

        return 'Adicionado com sucesso';
    }


    /**
     * Get COMPRA state
     */
    public function actionState($accesstoken)
    {

    }

    /**
     * Shows all COMPRAS
     */
    public function actionDelete($accesstoken)
    {

    }

}
