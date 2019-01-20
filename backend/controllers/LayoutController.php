<?php

namespace backend\controllers;

use common\models\Campanha;
use common\models\Categoria;
use common\models\CategoriaChild;
use common\models\Compra;
use common\models\Userdata;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
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
        $userData = Userdata::findOne(['user_id' => Yii::$app->user->id]);

        Yii::$app->view->params['userData'] = $userData;

        return parent::beforeAction($action);
    }
}
