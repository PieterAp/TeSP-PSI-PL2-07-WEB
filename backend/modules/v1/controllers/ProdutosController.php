<?php

namespace app\modules\v1\controllers;

use DateTime;
use Yii;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `v1` module
 */
class ProdutosController extends ActiveController
{
    public $modelClass = 'common\models\Produto';

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    /**
     * Defines actions which are not allowed
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'],//POST
              $actions['update'],//PUT & PATCH {id}
              $actions['delete']);//DELETE {id}
        return $actions;
    }

    /**
     * Shows the user which actions and routes are available to use
     * @return array
     */
    public function actionHelp()
    {
        $help[] = array( 'allowed actions' => 'get');

        $get = array( 'action' => 'get' , 'routes' => array() );
        $get['routes'][] = array('todas as categorias disponiveis' => 'categorias');
        $help[] = $get;

        return array($help);
    }

    /**
     * @return mixed
     */
    public function actionAvailable()
    {
        $model = new $this->modelClass;
        $allProdutos = $model::find()->where(['produtoEstado'=>1])->all();

        return $allProdutos;
    }
}
