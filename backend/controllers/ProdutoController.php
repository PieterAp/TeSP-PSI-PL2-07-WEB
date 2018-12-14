<?php

namespace backend\controllers;

use common\models\Campanha;
use common\models\Produtocampanha;
use Yii;
use common\models\Produto;
use app\models\ProdutoSearch;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

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
                        'actions' => ['produtocampanha','index','create','view','changeestado','stock'],
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
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produto();

        $model->produtoDataCriacao = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {

            $images = [];

            for ($k=1; $k<5; $k++)
            {
                $images[] = UploadedFile::getInstance($model, ('produtoImagem'.$k));

                if ($images[$k-1] != null)
                {
                    $model->{'produtoImagem'.$k} = $images[$k-1]->baseName.'.'.$images[$k-1]->extension;
                }

            }

            if ($model->save())
            {
                $path = Url::to('@frontend/web/images/products/'.$model->idprodutos);

                FileHelper::createDirectory($path);


                for ($i=0; $i<count($images); $i++)
                {
                    if ($images[$i]!=null)
                    {
                        $images[$i]->saveAs($path.'/'.$model->{'produtoImagem'.($i+1)});
                    }
                }

                return $this->redirect(['view', 'id' => $model->idprodutos]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws Exception
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $beforeUpdate = Produto::find()
                        ->where(['idprodutos' => $id])
                        ->one();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $images = [];

            for ($k=1; $k<=4; $k++)
            {
                if (UploadedFile::getInstance($model, ('produtoImagem'.$k))!=null)
                {
                    $images[$k] = UploadedFile::getInstance($model, ('produtoImagem'.$k));
                    $model->{'produtoImagem'.$k} = $images[$k]->baseName.'.'.$images[$k]->extension;
                }
                elseif (UploadedFile::getInstance($model, ('produtoImagem'.$k))==null)
                {
                    $model->{'produtoImagem'.$k} = $beforeUpdate->{'produtoImagem'.$k};
                }
            }

            if ($model->save())
            {
                $path = Url::to('@frontend/web/images/products/'.$model->idprodutos);

                FileHelper::createDirectory($path);

                foreach ($images as $position=>$image)
                {
                    $images[$position]->saveAs($path.'/'.$model->{'produtoImagem'.($position)});

                }

                return $this->redirect(['view', 'id' => $model->idprodutos]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
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

        if ($model->produtoEstado==1)
        {
            $model->produtoEstado=0;
        }
        else
        {
            $model->produtoEstado=1;
        }
        $model->save();

        return $this->redirect(['index']);
    }


    public function actionStock($id,$action)
    {
        $model = $this->findModel($id);

        if($action=='add')
        {
            $model->produtoStock++;
        }
        elseif ($action=='remove')
        {
            $model->produtoStock--;
        }

        $model->save();
        return $this->redirect(['index']);
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
