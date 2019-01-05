<?php

namespace app\modules\v1\controllers;

use common\models\User;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Compraprodutos controller for the `v1` module
 */
class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';

    /**
     * Behaviors defined for this controller
     *
     * In this particular case, without this function the JSON format
     * in Module.php would not work, which means that \yii\base\Behavior
     * is not actually needed, but also does no harm.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'class' => \yii\base\Behavior::className(),
        ];
    }

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

    }

    /**
     * Allows user to create a new account
     */
    public function actionRegisto()
    {
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');

        $user = new User();
        $user->username = $username;
        $user->password = $password;

        $ret = $user->save();
        return ['SaveError' => $ret];
    }
}
