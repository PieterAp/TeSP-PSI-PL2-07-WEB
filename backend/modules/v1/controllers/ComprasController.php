<?php

namespace app\modules\v1\controllers;

use DateTime;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Compras controller for the `v1` module
 */
class ComprasController extends ActiveController
{
    public $modelClass = 'common\models\Compra';

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
