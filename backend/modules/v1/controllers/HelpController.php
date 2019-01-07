<?php

namespace app\modules\v1\controllers;

/**
 * Help controller for the `v1` module
 */
class HelpController extends \yii\rest\Controller
{
    //no modelClass!! Because one isn't needed.

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
        $campanhas = array( 'controller name' => 'campanhas' ,'allowed actions' => 'get / delete', 'access' => 'unrestricted' , 'routes' => array() );
        $campanhas['routes'][] = array('action' => 'get',
                                                        'todas as campanhas disponiveis' => 'campanhas',
                                                        'campanha detalhe' => 'campanhas/{id}',
                                                        'produtos dentro de campanha' => 'campanhas/{id}/produtos',
                                                        'todos os endpoints disponiveis' => 'campanhas/help');
        $campanhas['routes'][] = array('action' => 'delete',
                                                            'elimina uma campanha' => 'campanhas/{id}');
        $help[] = $campanhas;



        $categoriasChild = array( 'controller name' => 'categoriaschild' ,'allowed actions' => 'get', 'access' => 'unrestricted' , 'routes' => array() );
        $categoriasChild['routes'] = array('todas as categoriaschild disponiveis' => 'categoriaschild',
                                           'todos os endpoints disponiveis' => 'categoriaschild/help',
                                           'categoriasChild detalhe' => 'categoriaschild/{id}',
                                           'produtos dentro de categoriaschild' => 'categoriaschild/{id}/produtos',
                                           'categoria pertencente à categoriaschild' => 'categoriaschild/{id}/categoria');
        $help[] = $categoriasChild;



        $categorias = array( 'controller name' => 'categorias' ,'allowed actions' => 'get', 'access' => 'unrestricted' , 'routes' => array() );
        $categorias['routes'][] = array('todas as categorias disponiveis' => 'categorias',
                                        'todos os endpoints disponiveis' => 'categorias/help',
                                        'categorias detalhe' => 'categorias/{id}',
                                        'produtos dentro de categoria' => 'categorias/{id}/produtos',
                                        'categorias child dentro de categoria' => 'categorias/{id}/child');
        $help[] = $categorias;



        $produtos = array( 'controller name' => 'produtos' ,'allowed actions' => 'get', 'access' => 'unrestricted' , 'routes' => array() );
        $produtos['routes'][] = array('todas os produtos disponiveis' => 'produtos',
                                      'produtos detalhe' => 'produtos/{id}',
                                      'campanhas relacionadas com produto' => 'produtos/{id}/campanhas',
                                      'categoria relacionada com produto' => 'produtos/{id}/categoria',
                                      'categoriaChild relacionada com produto' => 'produtos/{id}/child');
        $help[] = $produtos;



        $users = array( 'controller name' => 'users' ,'allowed actions' => 'get / post / put', 'access' => 'restricted & unrestricted' , 'routes' => array() );
        $users['routes'][] = array('action' => 'get', 'access' => 'unrestricted',
                                                                                'todos os endpoints disponiveis' => 'users/help');
        $users['routes'][] = array('action' => 'post', 'access' => 'unrestricted',
                                                                                'registo user' => 'users/registo?{fields}',
                                                                                'login user' => 'users/login?{fields}');
        $users['routes'][] = array('action' => 'put', 'access' => 'restricted',
                                                                                'editar conta user' => 'users/?access-token={token}?accesstoken={token}?{fields}');
        $help[] = $users;




        return $help;
    }
}
