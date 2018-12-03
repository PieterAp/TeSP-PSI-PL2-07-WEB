<?php

namespace frontend\controllers;

use common\models\Categoria;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: Pieter
 * Date: 20/11/2018
 * Time: 21:49
 */

class LayoutController extends Controller
{
    /**
     * Populates the category navbar in frontend/views/layouts/main.php
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $categorias = Categoria::find()->orderBy("categoriaNome")->all();

        foreach ($categorias as $categoria)
        {
            $categoriaNavbar[]= ['label' => '' . $categoria->categoriaNome .'', 'url' => Url::to(['categoria/view', 'id' => $categoria->idcategorias])];
        }

        Yii::$app->view->params['categoriaNavbar'] = $categoriaNavbar;

        return parent::beforeAction($action);
    }
}