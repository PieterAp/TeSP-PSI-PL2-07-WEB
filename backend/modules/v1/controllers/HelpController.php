<?php

namespace app\modules\v1\controllers;

use DateTime;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Help controller for the `v1` module
 */
class HelpController extends \yii\rest\Controller
{
    //no modelClass!! Because one isn't needed.

    /**
     * Just to reinforce JSON format, as in some applications the format showed as XML, no good!
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
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
        $campanhas = array( 'controller name' => 'campanhas' ,'allowed actions' => 'get' , 'routes' => array() );
        $campanhas['routes'] = array('todas as campanhas disponiveis' => 'campanhas',
                                       'produtos dentro de campanha' => 'campanhas/{id}/produtos');
        $help[] = $campanhas;

        $categoriasChild = array( 'controller name' => 'categoriaschild' ,'allowed actions' => 'get' , 'routes' => array() );
        $categoriasChild['routes'] = array('todas as categoriaschild disponiveis' => 'categoriaschild',
                                           'categoria pertencente à categoriaschild' => 'categoriaschild/{id}/categoria',
                                           'produtos dentro de categoriaschild' => 'categoriaschild/{id}/produtos');
        $help[] = $categoriasChild;

        $categorias = array( 'controller name' => 'categorias' ,'allowed actions' => 'get' , 'routes' => array() );
        $categorias['routes'] = array('todas as categorias disponiveis' => 'categorias',
                                      'produtos dentro de categoria' => 'categorias/{id}/produtos');
        $help[] = $categorias;

        $categorias = array( 'controller name' => 'categorias' ,'allowed actions' => 'get, post, put' , 'routes' => array() );
        $categorias['routes'][] = array('action' => 'get',
                                        'todas as categorias disponiveis' => 'categorias',
                                        'produtos dentro de categoria' => 'categorias/{id}/produtos');
        $categorias['routes'][] = array('action' => 'post',
                                        'todas as categorias disponiveis' => 'categorias',
                                        'produtos dentro de categoria' => 'categorias/{id}/produtos');
        $categorias['routes'][] = array('action' => 'put',
                                        'todas as categorias disponiveis' => 'categorias',
                                        'produtos dentro de categoria' => 'categorias/{id}/produtos');
        $help[] = $categorias;

        return $help;
    }
}
