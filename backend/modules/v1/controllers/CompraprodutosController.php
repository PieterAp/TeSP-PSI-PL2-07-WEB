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
}
