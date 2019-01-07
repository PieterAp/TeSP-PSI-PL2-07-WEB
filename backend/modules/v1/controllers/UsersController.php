<?php

namespace app\modules\v1\controllers;

use common\models\LoginForm;
use common\models\User;
use common\models\Userdata;
use frontend\models\EditAccountForm;
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
     * API Authorization - Query Parameter Authentication
     */
    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['help','login','registo'],
        ];
        return $behaviors;
    }

    /**
     * Shows the user which actions and routes are available to use
     * @return array
     */
    public function actionHelp()
    {
        $help[] = array( 'allowed actions' => 'post');

        $get = array( 'action' => 'post', 'access' => 'unrestricted', 'routes' => array() );
        $get['routes'][] = array('registo de um user' => 'user/registo',
                                'login de um user' => 'user/login');
        $help[] = $get;

        return array($help);
    }


    /**
     * Allows user to log into their accounts
     */
    public function actionLogin()
    {
        $user = new LoginForm();
        $user->username =   \Yii::$app->request->post('username');
        $user->password =   \Yii::$app->request->post('password');

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

        $signupForm->username = \Yii::$app->request->post('username');
        $signupForm->userNomeProprio = \Yii::$app->request->post('firstname');
        $signupForm->userApelido = \Yii::$app->request->post('lastname');
        $signupForm->userNIF = \Yii::$app->request->post('nif');
        $signupForm->userMorada = \Yii::$app->request->post('address');
        $signupForm->userDataNasc = \Yii::$app->request->post('birthday');
        $signupForm->email = \Yii::$app->request->post('email');
        $signupForm->password = (\Yii::$app->request->post('password'));

        if (!$signupForm->validate()){
            return $signupForm->errors;
        }

        $userdata = new Userdata();
        $user = new User();

        $user->username = $signupForm->username;
        $user->email = $signupForm->email;
        $user->setPassword($signupForm->password);
        $user->generateAuthKey();
        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('cliente');
        $auth->assign($authorRole, $user->getId());
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

    /**
     * Allows user to edit his account
     */
    public function actionEdit($accesstoken,$password,$firstname,$lastname,$address,$birthday)
    {
        $user = User::findIdentityByAccessToken($accesstoken);
        $editAccount = new EditAccountForm();
        $editAccount->userNomeProprio = $password;
        $editAccount->userNomeProprio = $firstname;
        $editAccount->userApelido = $lastname;
        $editAccount->userMorada = $address;
        $editAccount->userDataNasc = $birthday;

        if ($editAccount->editAccount()) {
            if($password != ''){
                $user->setPassword($password);
                $user->save();
            }

            $userdata = Userdata::find()->where(['user_id' => $user->id])->one();
            $userdata->userNomeProprio = $editAccount->userNomeProprio;
            $userdata->userApelido = $editAccount->userApelido;
            $userdata->userMorada = $editAccount->userMorada;
            $userdata->userDataNasc = $editAccount->userDataNasc;
            $userdata->save(false);

        }else{
            return $editAccount->errors;
        }
        return "Alteracao com sucesso";
    }
}
