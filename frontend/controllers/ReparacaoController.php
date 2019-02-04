<?php

namespace frontend\controllers;

use Yii;
use common\models\Reparacao;
use app\models\ReparacaoSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReparacaoController implements the CRUD actions for Reparacao model.
 */
class ReparacaoController extends LayoutController
{

    /**
     * Lists all Reparacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userID = Yii::$app->user->id;

        $reparacoes = (new Query())
            ->select(['reparacao.*'])
            ->from('reparacao')
            ->where(['user_iduser'=>$userID])
            ->orderBy('reparacaoData DESC')
            ->all();

        return $this->render('index', [
            'reparacoes' => $reparacoes,
        ]);
    }

    /**
     * Finds the Reparacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reparacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reparacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
