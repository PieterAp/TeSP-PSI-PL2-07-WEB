<?php

namespace app\modules\v1\controllers;

use common\models\Categoria;
use yii\db\Query;
use yii\rest\ActiveController;

/**
 * Categoriaschild controller for the `v1` module
 */
class CategoriaschildController extends ActiveController
{
    public $modelClass = 'common\models\CategoriaChild';

    /**
     * Behaviors defined for this controller
     *
     * In this particular case, without this function the JSON format
     * in Module.php would not work, which means that \yii\base\Behavior
     * is not actually needed, but also does no harm.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'class' => \yii\base\Behavior::className(),
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
        $help[] = array( 'allowed actions' => 'get');

        $get = array( 'action' => 'get' , 'routes' => array() );
        $get['routes'][] = array('todas as categoriaschild disponiveis' => 'categoriaschild',
                                 'categoria pertencente à categoriaschild' => 'categoriaschild/{id}/categoria',
                                 'produtos dentro de categoriaschild' => 'categoriaschild/{id}/produtos');
        $help[] = $get;

        return array($help);
    }

    /**
     * @return mixed
     */
    public function actionAvailable()
    {
        $allCategoriaschild = (new Query())
            ->select(['categoria_child.*','COUNT(produto.idprodutos) as "qntProdutos"'])
            ->from('categoria_child')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['categoria_child.childEstado'=>1])
            ->andWhere(['produto.produtoEstado'=>1])
            ->all();

        return $allCategoriaschild;
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionCategoria($id)
    {
        $selectedCategoria = Categoria::find()
            ->select('categoria.*')
            ->innerJoin('categoria_child', '`categoria_child`.`categoria_idcategorias` = `categoria`.`idcategorias`')
            ->where(['categoria_child.idchild' => $id])
            ->all();

        return $selectedCategoria;
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionProdutos($id)
    {
        $allProducts = (new Query())
            ->select('produto.*')
            ->from('categoria_child')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['idchild' => $id])
            ->all();

        return $allProducts;
    }
}
