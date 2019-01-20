<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Userdata;
use app\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends LayoutController
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
                        'actions' => ['create', 'index','view'],
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

        $rows = (new Query())
            ->select(['id','username', 'userNomeProprio', 'userApelido', 'userVisibilidade'])
            ->from('user')
            ->innerJoin('userdata','user_id=id')
            ->orderBy('id');

        $model = (new Query())
            ->select(['id','username', 'userNomeProprio', 'userApelido', 'userVisibilidade'])
            ->from('user')
            ->innerJoin('userdata','user_id=id')
            ->orderBy('id')
            ->all();

        $dataProvider = new ActiveDataProvider(['query' => $rows]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
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

        $userdata = Userdata::find()->where(['user_id' => $id])->one();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'userdata' => $userdata,
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
        $userdata = new Userdata();
        if ($model->load(Yii::$app->request->post()) &&  $userdata->load(Yii::$app->request->post())) {
            if (\Yii::$app->user->can('deleteCompras')) {
                var_dump('yes');
            }else{
                var_dump('no');
            }

            foreach (Yii::$app->request->post('User') as $row)
            {
                $model->username = $row;
            }
            $model->generateAuthKey();
            $model->email = $model->username . $userdata->userNomeProprio . '@fixbyte.com.pt' ;
            echo Yii::$app->request->post('password');
            if(Yii::$app->request->post('password') != ''){
                $model->setPassword(Yii::$app->request->post('password'));
            }
            $model->save(false);

            $identity = User::findOne(['username' => $model->username]);
            $userdata->user_id = $identity->id;

            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('funcionario');
            $auth->assign($authorRole, $model->getId());
            $userdata->save(false);

            /*$userdata = new Userdata();
            $userdata->userNomeProprio = $this->userNomeProprio;
            $userdata->userApelido = $this->userApelido;
            $userdata->userNIF = $this->userNIF;
            $userdata->userDataNasc = $this->userDataNasc;
            $userdata->userMorada =$this->userMorada;
            $identity = User::findOne(['username' => $user->username]);
            $userdata->user_id =$identity->id;

            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('funcionario');
            $auth->assign($authorRole, $user->getId());
            */


            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'userdata' => $userdata,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userdata = Userdata::find()->where(['user_id' => $id])->one();

        //$user->setPassword(Yii::$app->request->post('password'));

        if (Yii::$app->request->post()) {
            $userdata->load(Yii::$app->request->post());
            $userdata->save(false);
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
            'userdata' => $userdata,
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
        $auth = \Yii::$app->authManager->getRolesByUser($id);
        $userdata = new Userdata;
        $role= '';
        if (array_key_exists ('admin' , $auth)){
            $role = 'admin';
        }

        if (($role != 'admin') ){
            $userdata = new Userdata();
            $userdata = Userdata::findOne(['iduser' => $id]);
            $userdata->userVisibilidade = 0;
            $userdata->save(false);
            return $this->redirect(['index']);
        }

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
