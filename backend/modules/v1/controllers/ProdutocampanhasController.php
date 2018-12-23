<?php

namespace app\modules\v1\controllers;

use DateTime;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Produtocampanhas controller for the `v1` module
 */
class ProdutocampanhasController extends ActiveController
{
    public $modelClass = 'common\models\Produtocampanha';

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
     * @param $campanha_idCampanha
     * @return mixed
     */
    public function actionAvailable($campanha_idCampanha)
    {
        $model = new $this->modelClass;
        $allProdutos = $model::find()->where(['campanha_idCampanha'=>$campanha_idCampanha])->all();

        return $allProdutos;
    }
}
