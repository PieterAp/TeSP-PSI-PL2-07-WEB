<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CategoriaChild */

$this->title = 'Create Sub-Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['categoria/index']];
if (isset($categoriaAssociada))
{
    $safeCategoriyName = preg_replace('/\s+/', '_', $categoriaAssociada['categoriaNome']);
    $this->params['breadcrumbs'][] = ['label' => $categoriaAssociada->categoriaNome, 'url' => ['categoria/index','#'=>$safeCategoriyName]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (isset($categoriaAssociada))
    {
        echo $this->render('_form', [
            'model' => $model,
            'categoriaAssociada' => $categoriaAssociada,
        ]);
    }
    else
    {
        echo $this->render('_form', [
            'model' => $model,
        ]);
    }
    ?>

</div>
