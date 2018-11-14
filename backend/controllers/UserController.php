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
                'rules' => [
                    [
                        'actions' => ['create', 'index'],
                        'allow' => true,
                        'roles' => ['admin', 'funcionario'],
                    ],
                    [
                        'actions' => ['delete'],
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
        $searchModelUser = new User();
        $searchModelUserdata = new Userdata();
        $rows = (new Query())
            ->select(['id','username', 'userNomeProprio', 'userApelido', 'userVisibilidade'])
            ->from('user')
            ->innerJoin('userdata','user_id=id');
        $command = $rows->createCommand();
        $data = $command->queryAll();

        $provider = new ActiveDataProvider([
            'query' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'title' => SORT_ASC,
                ]
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $provider,
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
        $userdata = new Userdata();
        if ($model->load(Yii::$app->request->post()) &&  $userdata->load(Yii::$app->request->post())) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
    public function actionDelete()
    {
        $userdata = new Userdata();
        $id=36;
        $identity = Userdata::findOne(['user_id' => $id]);
        $userdata->user_id =$identity->id;
        $userdata->user_id = $identity->user_id;
        var_dump($identity);
        die();
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
