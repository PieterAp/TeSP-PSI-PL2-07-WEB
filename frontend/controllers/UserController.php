<?php

namespace frontend\controllers;

use common\models\Userdata;
use Yii;
use frontend\models\editAccountForm;
use common\models\User;
use frontend\models\SignupForm;
use app\models\UserSearch;
use yii\debug\models\search\Debug;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\log\Logger;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','historic'],
                'rules' => [
                    [
                        'actions' => ['index','historic'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'update+-+-
     * ' page.
     * @return mixed, $user from user table and $usedata from userdata table
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = new EditAccountForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->editAccount()) {
                if(Yii::$app->request->post('password') != ''){
                    $user = $this->findModel(Yii::$app->user->id);
                    $user->setPassword(Yii::$app->request->post('password'));
                    $user->save();
                }else{
                    $userdata = Userdata::find()->where(['user_id' => Yii::$app->user->id])->one();
                    $userdata->userNomeProprio = $model->userNomeProprio;
                    $userdata->userApelido = $model->userApelido;
                    $userdata->userMorada = $model->userMorada;
                    $userdata->userDataNasc = $model->userDataNasc;
                    $userdata->save();
                }
            }
        }else{
            $user = User::find()->select('username')->where(['id' => Yii::$app->user->id])->one();
            $model->username = $user->username;
            $id = Yii::$app->user->id;
            $userdata = Userdata::find()->where(['user_id' => $id])->one();
            $model->userNomeProprio = $userdata->userNomeProprio;
            $model->userApelido = $userdata->userApelido;
            $model->userDataNasc = $userdata->userDataNasc;
            $model->userMorada = $userdata->userMorada;
            $model->userNIF = $userdata->userNIF;
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
