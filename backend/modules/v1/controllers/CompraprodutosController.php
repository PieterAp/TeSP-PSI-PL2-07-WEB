<?php

namespace app\modules\v1\controllers;

use DateTime;
use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Compraprodutos controller for the `v1` module
 */
class CompraprodutosController extends ActiveController
{
    public $modelClass = 'common\models\Compraproduto';

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
}
