<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    if ($allCategories==null)
    {
        echo '
        <ul class="list-group"  style="margin-top: 50px;">
          <li class="list-group-item list-group-item-danger">No categories available!!</li>
        </ul>

        ';
    }
    else
    {
    foreach ($allCategories as $eachCategory)
    {
        $safeCategoriyName = preg_replace('/\s+/', '_', $eachCategory['categoriaNome']);

        echo '
            <div class="panel panel-info " style="margin-top: 50px; margin-bottom: 0px;" id="'.$safeCategoriyName.'">
                <div class="panel-heading" style="padding-top: 0px; padding-bottom: 0px;">
                    <div class="row" style="display: flex; align-items: center;">
                        <div class="col-lg-10 col-md-10 col-xs-10">
                            <h3 class="panel-title"><strong>'.$eachCategory['categoriaNome'].'</strong><span style="color: #5e5e5e"> - <a href="'.Url::to(['categoria/indexproduto', 'idCategoria' => $eachCategory['idcategorias']]).'">'.$eachCategory['qntProdutos'].' products <span class="glyphicon glyphicon-share-alt"></span></a></span></h3>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-2 text-right">
                            <ul class="nav navbar-nav navbar-right text-center pull-right">
                                <li>
                                    <a href="'.Url::to(['categoria/changeestado', 'id' => $eachCategory['idcategorias']]).'" id="hide'.$safeCategoriyName.'">';
                                    if ($eachCategory['categoriaEstado']==1)
                                    {
                                        echo '<span class="glyphicon glyphicon-eye-close"></span> Hide Cat</a></li>';
                                    }
                                    else
                                    {
                                        echo '<span class="glyphicon glyphicon-eye-open"></span> Unhide Cat</a></li>';
                                    }
                           echo'</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="padding-top: 0px; padding-bottom: 0px; padding-left: 15px;  padding-right: 15px;">
                    <div class="row" style="display: flex; align-items: center;">
                        <div class="col-lg-9 col-md-8 col-xs-9" style="padding-right: 0px">';
                        if ($eachCategory['categoriaDescricao']!=null)
                        {
                            echo'<h4 class="text-left">'.$eachCategory['categoriaDescricao'].'</h4>';
                        }
                        else
                        {
                            echo'<h4 class="text-left" style="color: #5e5e5e">No description available</h4>';
                        }
                    echo'
                        </div>
                         <div class="col-lg-3 col-md-4 col-xs-4" style="padding-left: 0px">
                            <ul class="nav navbar-nav navbar-right text-center pull-right">
                                <li><a data-toggle="collapse" href="#collapse'.$safeCategoriyName.'" aria-expanded="false" aria-controls="collapse'.$safeCategoriyName.'"><span class="glyphicon glyphicon-th-list"></span><br>View sub</a></li>
                                <li><a href="'.Url::to(['categoria/update', 'id' => $eachCategory['idcategorias']]).'" id="edit'.$safeCategoriyName.'"><span class="glyphicon glyphicon-pencil"></span><br>Edit</a></li>';
                                if ((\Yii::$app->user->can('deleteCategoria')) && ($eachCategory['qntProdutos']==0) && ($eachCategory['qntCategoriasChild']==0))
                                {
                                    echo '<li>'.Html::a('<span class="glyphicon glyphicon-trash"></span><br>Delete',['categoria/delete','id'=>$eachCategory['idcategorias']],['id' => 'delete'.$safeCategoriyName, 'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ]]).'</li>';
                                }
                                else
                                {
                                    if ((!(\Yii::$app->user->can('deleteCategoria'))) && ($eachCategory['qntCategoriasChild']>0) && ($eachCategory['qntProdutos']>0))
                                    {
                                    $liTitle = 'User has no permission and category contains prodcuts & sub-categories';
                                    }
                                    elseif ((!(\Yii::$app->user->can('deleteCategoria'))) && ($eachCategory['qntProdutos']>0))
                                    {
                                        $liTitle = 'User has no permission and category contains products';
                                    }
                                    elseif ((!(\Yii::$app->user->can('deleteCategoria'))) && ($eachCategory['qntCategoriasChild']>0))
                                    {
                                        $liTitle = 'User has no permission and category contains sub-categories';
                                    }
                                    elseif (($eachCategory['qntCategoriasChild']>0) && ($eachCategory['qntProdutos']>0))
                                    {
                                        $liTitle = 'Category contains products & sub-categories';
                                    }
                                    elseif (!(\Yii::$app->user->can('deleteCategoria')))
                                    {
                                        $liTitle = 'User has no permission';
                                    }
                                    elseif ($eachCategory['qntProdutos']>0)
                                    {
                                        $liTitle = 'Category contains products';
                                    }
                                    elseif ($eachCategory['qntCategoriasChild']>0)
                                    {
                                        $liTitle = 'Category contains sub-categories';
                                    }
                                    echo '<li title="'.$liTitle.'" class="disabled"><a><span class="glyphicon glyphicon-trash"></span><br>Delete</a></li>';
                                }
                                echo '
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        ';


    echo '<div class="collapse" id="collapse'.$safeCategoriyName.'">
<div class="panel-group" id="accordion'.$safeCategoriyName.'" role="tablist" aria-multiselectable="true">



<div class="panel panel-success">
    <div class="panel-heading" role="tab" id="create">
      <h4 class="panel-title text-center">
        <a style="color: #449D44;" role="button" data-parent="#accordion'.$safeCategoriyName.'" href="'.Url::to(['categoria-child/create', 'id' => $eachCategory['idcategorias']]).'" aria-expanded="true" aria-controls="collapseOne">
          Create new sub-category <span class="glyphicon glyphicon-plus-sign"></span>
        </a>
      </h4>
    </div>
  </div>';

    $i=0;
    foreach ($allCategoryChilds as $eachCategoryChild)
    {

        if($eachCategoryChild['categoria_idcategorias']==$eachCategory['idcategorias'])
        {
            $ii = ($i==0) ? "in" : null;

            $safeChildName = preg_replace('/\s+/', '_', $eachCategoryChild['childNome']);

            echo'
              <div class="panel panel-default" style="margin-top: 0px;" id="'.$safeChildName.'">
                <div class="panel-heading" role="tab">
                  <h4 class="panel-title text-center">
                    <div class="row" style="display: flex; align-items: center;">
                        <div class="col-lg-6 col-md-6 col-xs-10 text-left">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion'.$safeCategoriyName.'" href="#collapse'.$safeChildName.'" aria-expanded="false" aria-controls="collapse'.$safeChildName.'"';
                        if ($i==0)
                        {
                            echo 'aria-expanded="true ">';
                        }
                        else
                        {
                            echo 'aria-expanded="false">';
                        }
                            echo'
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion'.$safeCategoriyName.'" href="#collapse'.$safeChildName.'" aria-expanded="false" aria-controls="collapse'.$safeChildName.'">
                                <h3 class="panel-title"><strong>'.$eachCategoryChild['childNome'].'</strong></h3>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-10 text-right">
                            <span style="color: #5e5e5e"><a href="'.Url::to(['categoria-child/indexproduto', 'idCategoriaChild' => $eachCategoryChild['idchild']]).'">'.$eachCategoryChild['qntProdutos'].' products <span class="glyphicon glyphicon-share-alt"></span></a></span>
                        </div>
                    </div>
                  </h4>
                </div>
                <div id="collapse'.$safeChildName.'" class="panel-collapse collapse';
                if ($i==0)
                {
                    echo ' in';
                }
                echo'
                    " role="tabpanel" aria-labelledby="collapse'.$safeChildName.'">
                  <div class="panel-body" style="padding-top: 0px; padding-bottom: 0px; padding-left: 15px;  padding-right: 15px;">
                    <div class="row" style="display: flex; align-items: center;">
                        <div class="col-lg-9 col-md-8 col-xs-9" style="padding-right: 0px">';
                        if ($eachCategoryChild['childDescricao']!=null)
                        {
                            echo'<h4 class="text-left">'.$eachCategoryChild['childDescricao'].'</h4>';
                        }
                        else
                        {
                            echo'<h4 class="text-left" style="color: #5e5e5e">No description available</h4>';
                        }
                    echo'
                        </div>
                         <div class="col-lg-3 col-md-4 col-xs-4" style="padding-left: 0px">
                            <ul class="nav navbar-nav navbar-right text-center pull-right">

                                    ';
                                    if ($eachCategoryChild['childEstado']==1)
                                    {
                                        echo '<li><a href="'.Url::to(['categoria-child/changeestado', 'id' => $eachCategoryChild['idchild']]).'"><span class="glyphicon glyphicon-eye-close"></span><br>Hide Sub</a></li>';
                                    }
                                    else
                                    {
                                        if ($eachCategory['categoriaEstado']==1)
                                        {
                                            echo '<li><a href="'.Url::to(['categoria-child/changeestado', 'id' => $eachCategoryChild['idchild']]).'"><span class="glyphicon glyphicon-eye-open"></span><br>Unhide Sub</a></li>';
                                        }
                                        else
                                        {
                                            echo '<li title="The main category is hidden!"  class="disabled"><a><span class="glyphicon glyphicon-eye-open"></span><br>Unhide Sub</a></li>';
                                        }
                                    }
                           echo'</li>
                                <li><a href="'.Url::to(['categoria-child/update', 'id' => $eachCategoryChild['idchild']]).'"><span class="glyphicon glyphicon-pencil"></span><br>Edit</a></li>';
                                if ((\Yii::$app->user->can('deleteCategoria')) && ($eachCategoryChild['qntProdutos']==0))
                                {
                                    echo '<li>'.Html::a('<span class="glyphicon glyphicon-trash"></span><br>Delete',['categoria-child/delete', 'id' => $eachCategoryChild['idchild']],['data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ]]).'</li>';
                                }
                                else
                                {
                                    if ((!(\Yii::$app->user->can('deleteCategoria'))) && ($eachCategoryChild['qntProdutos']>0))
                                    {
                                        $liTitle = 'User has no permission and category contains products';
                                    }
                                    elseif (!(\Yii::$app->user->can('deleteCategoria')))
                                    {
                                        $liTitle = 'User has no permission';
                                    }
                                    elseif ($eachCategoryChild['qntProdutos']>0)
                                    {
                                        $liTitle = 'Category contains products';
                                    }
                                    echo '<li title="'.$liTitle.'" class="disabled"><a><span class="glyphicon glyphicon-trash"></span><br>Delete</a></li>';
                                }
                                echo '
                            </ul>
                        </div>
                    </div>

                  </div>
                </div>
              </div>';
            $i++;
        }

    }

  echo'
</div>
</div>';
    }
    }
    ?>
</div>
