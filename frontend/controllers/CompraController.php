<?php

namespace frontend\controllers;

use common\models\Compraproduto;
use common\models\Produto;
use common\models\User;
use Yii;
use common\models\Compra;
use app\models\CompraSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends LayoutController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','historic','cart','purchase','delete'],
                'rules' => [
                    [
                        'actions' => ['index','historic','cart','purchase','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * save models after purchase
        If creation is successful, the browser will be redirected to the 'purchase' page, if not go to 'errorstock' view.
     */
    public function actionPurchase()
    {
        $compra = Compra::find()
            ->where(['user_iduser' => Yii::$app->user->id, 'compraEstado'=> 1])
            ->one();

        $cart = Compraproduto::find()
            ->where (['compra_idcompras' => $compra->idcompras])
            ->all();
        $compra->compraEstado = 0;

        foreach ($cart as $key){
            $produto = Produto::find()
                ->where (['idprodutos' => $key->produto_idprodutos])
                ->one();
            if ($produto->produtoStock >0){
                $produto->produtoStock -= 1;
                $produto->save();
            }else{

                $myCommand =  Yii::$app->db->createCommand()
                    ->delete('compraproduto', 'compra_idcompras = '.$key->compra_idcompras.' AND produto_idprodutos = '.$key->produto_idprodutos.' AND produto_preco = '.$key->produto_preco.' limit 1');
                $check = $myCommand->execute();

                if ($check == 1){
                    $compra->compraValor = $compra->compraValor - $key->produto_preco;
                    $compra->save();
                    $nostock[] = $produto->produtoNome .' - '. $key->produto_preco;
                }
            }
        }
        $compra->save();
        if (isset($nostock)){
            return $this->redirect(['cart', 'nostock' => $nostock]);

        }else{
            return $this->redirect(['cart']);
        }

    }
    /**
     * Displays a single Compra model.
     * @return mixed
     * @return $total integer with the price of all prodocts in cart
     */
    public function actionCart()
    {
        $rows = (new Query())
            ->select(['produto_preco','compraData','produtoNome','produtoMarca','produtoStock','produtoImagem1','idprodutos'])
            ->from('userdata')
            ->innerJoin('compra','user_iduser=iduser')
            ->innerJoin('compraproduto','compra_idcompras=idcompras')
            ->innerJoin('produto','produto_idprodutos=idprodutos')
            ->where(['iduser'=>Yii::$app->user->id, 'compraEstado' => 1]);

        $total = Compra::find()
            ->where(['user_iduser' => Yii::$app->user->id, 'compraEstado'=> 1])
            ->one();
        $cart = $rows->all();

        return $this->render('cart',[
            'cart' => $cart,
            'total' => $total,

        ]);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $produto = Produto::findOne(['idprodutos'=>$id]);
        $camp = (new Query())
            ->select(['produto.*',
                'produtocampanha.campanhaPercentagem',
                'produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"'])
            ->from('campanha')
            ->leftJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->leftJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->andWhere(['produto.produtoEstado'=>1])
            ->andWhere(['idprodutos' => $id])
            ->groupBy('idCampanha')
            ->orderBy("campanhaDataFim, produtoDataCriacao DESC")
            ->limit(8)
            ->one();
        var_dump($camp);
        $compra = Compra::find()
            ->where(['user_iduser' => Yii::$app->user->id, 'compraEstado'=> 1])
            ->one();

        if ($produto->produtoStock > 0){
            if($compra == null){  //se nao existir CART, CRIA
                $compra = new Compra();
                $compra->compraData = date('Y-m-d H:i:s');
                $compra->user_iduser = Yii::$app->user->id;
                if ($camp != null or $camp != false){ //SE O PRODUTO TIVER EM CAMPANHA METE O PREÇO DA CAMPANHa
                    $compra->compraValor = $camp['precoDpsDesconto'];
                    $compra->save();
                    $produto->save(false);
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $camp['precoDpsDesconto'];
                }else{
                    $compra->compraValor = $produto->produtoPreco;
                    $compra->save();
                    $produto->save(false);
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $produto->produtoPreco;
                }
                $compraproduto->compra_idcompras = $compra->idcompras;
                $compraproduto->produto_idprodutos = $id;
                $produto->produtoStock = $produto->produtoStock -1;
                $produto->save(false);
                $compraproduto->save(false);
            }else{ // se existir CART adiciona ao CART
                $compra->compraData = date('Y-m-d H:i:s');
                $compra->user_iduser = Yii::$app->user->id;
                if ($camp != null or $camp != false){ //SE O PRODUTO TIVER EM CAMPANHA METE O PREÇO DA CAMPANHA
                    $compra->compraValor += $camp['precoDpsDesconto'];
                    $compra->save();
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $camp['precoDpsDesconto'];
                }else{
                    $compra->compraValor += $produto->produtoPreco;
                    $compra->save();
                    $compraproduto = new Compraproduto();
                    $compraproduto->produto_preco = $produto->produtoPreco;
                }
                $compraproduto->compra_idcompras = $compra->idcompras;
                $compraproduto->produto_idprodutos = $id;
                $produto->produtoStock = $produto->produtoStock -1;
                $produto->save(false);
                $compraproduto->save(false);
            }
        }else {
            return $this->render('errorstock');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
    /**
     * Deletes an existing Compra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('idproduto');
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $compra = Compra::find()
                ->where(['user_iduser' => Yii::$app->user->id, 'compraEstado'=> 1])
                ->one();

            $cart = Compraproduto::find()
                ->where (['compra_idcompras' => $compra->idcompras])
                ->andWhere(['produto_idprodutos' => Yii::$app->request->post('idproduto')])
                ->all();

            $myCommand =  Yii::$app->db->createCommand()
                ->delete('compraproduto', 'compra_idcompras = '.$cart[0]->compra_idcompras.' AND produto_idprodutos = '.$cart[0]->produto_idprodutos.' AND produto_preco = '.$cart[0]->produto_preco.' limit 1');
            $check = $myCommand->execute();

            if ($check == 1){
                $compra->compraValor = $compra->compraValor - $cart[0]->produto_preco;
                $compra->save();
            }
            $rows = (new Query())
                ->select(['count(*)'])
                ->from('userdata')
                ->innerJoin('compra','user_iduser=iduser')
                ->innerJoin('compraproduto','compra_idcompras=idcompras')
                ->innerJoin('produto','produto_idprodutos=idprodutos')
                ->where(['iduser'=>Yii::$app->user->id, 'compraEstado' => 1]);
            $cart = $rows->all();

            return [
                'check' => $id,
                'total' =>$compra->compraValor,
                'count' =>$compra->compraValor
            ];
        }
    }

    /**
     * Finds the Compra model based on its primary key value.
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionHistoric()
    {
        $rows = (new Query())
            ->select(['produto_preco','compraData','produtoNome','produtoMarca'])
            ->from('userdata')
            ->innerJoin('compra','user_iduser=iduser')
            ->innerJoin('compraproduto','compra_idcompras=idcompras')
            ->innerJoin('produto','produto_idprodutos=idprodutos')
            ->where(['iduser'=>Yii::$app->user->id, 'compraEstado' => 0]);

        $dataProvider = new ActiveDataProvider(['query' => $rows]);

        return $this->render('historic',[
            'dataProvider' => $dataProvider,
        ]);
    }

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
