<?php

namespace app\modules\v1\controllers;

use common\models\User;
use yii\db\Query;
use yii\rest\ActiveController;

/**
 * Reparacoes controller for the `v1` module
 */
class ReparacoesController extends ActiveController
{
    public $modelClass = 'common\models\Reparacao';

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
     * Shows all CATEGORIA's which have visible PRODUTO's and which are visible themselves
     * @return mixed
     */
    public function actionAvailable($accesstoken)
    {
        $user = User::findIdentityByAccessToken($accesstoken);
        if ($user == null or empty($user)){
            return false;
        }

        $allReparacoes = (new Query())
            ->select(['reparacao.*'])
            ->from('reparacao')
            ->where(['user_iduser'=>$user->id])
            ->all();

        if ($allReparacoes!=null)
        {
            foreach($allReparacoes as $key=>$oneReparacao)
            {
                $oneReparacao['idreparacao'] = (int) $oneReparacao['idreparacao'];
                $oneReparacao['reparacaoNumero'] = (int) $oneReparacao['reparacaoNumero'];
                $oneReparacao['user_iduser'] = (int) $oneReparacao['user_iduser'];

                $allReparacoes[$key] = $oneReparacao;
            }
            return $allReparacoes;
        }
        return null;
    }
}
