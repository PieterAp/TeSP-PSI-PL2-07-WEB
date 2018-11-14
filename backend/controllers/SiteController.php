<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $auth = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
            $role= '';
            if (array_key_exists ('admin' , $auth)){
                $role = 'admin';
            }
            if (array_key_exists ('cliente' , $auth)){
                $role = 'cliente';
            }
            if (array_key_exists ('funcionario' , $auth)){
               $role = 'funcionario';
            }

            if (($role != 'admin') && ($role != 'funcionario')){
                Yii::$app->user->logout();
                return $this->render('index');
            }

            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function getRoleUserOne(){
        $auth = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if (array_key_exists ('admin' , $auth)){
            return 'admin';
        }
        if (array_key_exists ('cliente' , $auth)){
            return 'admin';
        }
        if (array_key_exists ('funcionario' , $auth)){
            return 'funcionario';
        }
    }
}
