<?php

namespace app\modules\v1\controllers;

use common\models\LoginForm;
use common\models\User;
use common\models\Userdata;
use frontend\models\SignupForm;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Compraprodutos controller for the `v1` module
 */
class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';

    /**
     * Shows the user which actions and routes are available to use
     * @return array
     */
    public function actionHelp()
    {
        $help[] = array( 'allowed actions' => 'get,post,put');

        $get = array( 'action' => 'get' , 'routes' => array() );
        $post['options'][] = array('label'=>['Label'],'value'=>['value']);
        $help[] = $get;


        $post = array( 'request' => 'post' , 'options' => array() );
        $post['options'][] = array('label'=>['Label'],'value'=>['value']);
        $help[] = $post;

        $put = array( 'request' => 'put' , 'options' => array() );
        $put['options'][] = array('label'=>['Label'],'value'=>['value']);
        $help[] = $put;


        return array($help);
    }


    /**
     * Allows user to log into their accounts
     */
    public function actionLogin()
    {
        $user = new LoginForm();
        $user->username =   \Yii::$app->request->get('username');
        $user->password =   \Yii::$app->request->get('password');

        if ($user->login()){
            $identity = User::findOne(['username' => $user->username]);
            $user = Userdata::findOne(['user_id' => $identity->id]);
            if ($user->userVisibilidade == '0'){
                Yii::$app->user->logout();
                return 'uservisibility is 0';
            }else{
                $identity = User::generateAccessToken($identity);
                return $identity;
            }
        }

        return false;

    }

    /**
     * Allows user to create a new account
     */
    public function actionRegisto()
    {
        $signupForm = new SignupForm();

        $signupForm->username = \Yii::$app->request->get('username');
        $signupForm->userNomeProprio = \Yii::$app->request->get('firstname');
        $signupForm->userApelido = \Yii::$app->request->get('lastname');
        $signupForm->userNIF = \Yii::$app->request->get('nif');
        $signupForm->userMorada = \Yii::$app->request->get('address');
        $signupForm->userDataNasc = \Yii::$app->request->get('birthday');
        $signupForm->email = \Yii::$app->request->get('email');
        $signupForm->password = (\Yii::$app->request->get('password'));

        if (!$signupForm->validate()){
            return $signupForm->errors;
        }

        $userdata = new UserData();
        $user = new User();

        $user->username = $signupForm->username;
        $user->email = $signupForm->email;
        $user->setPassword($signupForm->password);
        $user->generateAuthKey();
        $user->save();

        $userdata->userNomeProprio =$signupForm->userNomeProprio;
        $userdata->userApelido = $signupForm->userApelido;
        $userdata->userNIF = $signupForm->userNIF;
        $userdata->userMorada = $signupForm->userMorada;
        $userdata->userDataNasc = $signupForm->userDataNasc;
        $identity = User::findOne(['username' => $user->username]);
        $userdata->user_id = $identity->id;
        $userdata->save();

        return 'Register successfully';

    }
}
