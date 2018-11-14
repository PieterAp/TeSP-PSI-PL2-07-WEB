<?php
namespace backend\components;
use Yii;

class BackendController extends \yii\web\Controller
{
    public function init(){
        parent::init();

    }
    public function getRoleUserOne(){
        $auth = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if (array_key_exists ('admin' , $auth)){
            return 'admin';
        }
        if (array_key_exists ('cliente' , $auth)){
            return 'admin';
        }
        if (array_key_exists ('funcionario' , $auth)){
            return 'funcionario';
        }


    }
}