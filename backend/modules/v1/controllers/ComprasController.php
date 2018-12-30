<?php

namespace app\modules\v1\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Compras controller for the `v1` module
 */
class ComprasController extends ActiveController
{
    public $modelClass = 'common\models\Compra';

    /**
     * API Authorization - Query Parameter Authentication
     */
    public function behaviors()
    {
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['help'],
        ];
        return $behaviors;
    }

    /**
     * Checks request autorization/access
     * @throws \yii\web\ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'create' or $action === 'update' or $action === 'delete')
        {
            if (\Yii::$app->user->isGuest)
            {
                throw new \yii\web\ForbiddenHttpException($action .' - Action only available to registered users!');
            }
        }
    }


    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     * @throws \yii\web\ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        $this->checkAccess($action);

        return parent::beforeAction($action);
    }

    /**
     * Shows the user which actions and routes are available to use
     * @return array
     */
    public function actionHelp()
    {
        $help[] = array( 'allowed actions' => 'get,post,put');

        $get = array( 'action' => 'get' , 'routes' => array() );
        $get['routes'][] = array('todas as compras executadas pelo utilizador $id' => 'compras');
        $help[] = $get;

        /*
        $post = array( 'request' => 'post' , 'options' => array() );
        $post['options'][] = array('label'=>['Label'],'value'=>['value']);
        $help[] = $post;

        $put = array( 'request' => 'put' , 'options' => array() );
        $put['options'][] = array('label'=>['Label'],'value'=>['value']);
        $help[] = $put;
        */

        return array($help);
    }

    /**
     * @return mixed
     */
    public function actionAvailable()
    {
        $model = new $this->modelClass;
        $allCompras = $model::find()->where(['compraEstado'=>1])->all();

        return $allCompras;
    }
}
