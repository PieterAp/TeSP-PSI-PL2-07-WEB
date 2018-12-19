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
                'only' => ['update'],
                'rules' => [
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
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
    public function actionBackend(){
        return $this->redirect(Yii::$app->urlManagerBackend->createUrl(['site/index']));
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
