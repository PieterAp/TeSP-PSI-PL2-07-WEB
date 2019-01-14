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
     * Shows all COMPRAS
     * @return void
     */
    public function actionGetcompras()
    {

    }

    /**
     * Shows all COMPRAS
     * @return void
     */
    public function actionSetcompras()
    {

    }
}
