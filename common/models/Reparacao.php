<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reparacao".
 *
 * @property int $idreparacao
 * @property string $reparacaoNome
 * @property string $reparacaoEstado
 * @property int $reparacaoNumero
 * @property string $reparacaoData
 * @property string $reparacaoDataConcluido
 * @property string $reparacaoDescricao
 * @property int $user_iduser
 *
 * @property Userdata $userIduser
 */
class Reparacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reparacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reparacaoNome', 'reparacaoNumero', 'reparacaoData', 'reparacaoDataConcluido', 'reparacaoDescricao', 'user_iduser'], 'required'],
            [['reparacaoEstado'], 'string'],
            [['reparacaoNumero', 'user_iduser'], 'integer'],
            [['reparacaoData', 'reparacaoDataConcluido'], 'safe'],
            [['reparacaoNome'], 'string', 'max' => 45],
            [['reparacaoDescricao'], 'string', 'max' => 128],
            [['user_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => Userdata::className(), 'targetAttribute' => ['user_iduser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idreparacao' => 'Idreparacao',
            'reparacaoNome' => 'Reparacao Nome',
            'reparacaoEstado' => 'Reparacao Estado',
            'reparacaoNumero' => 'Reparacao Numero',
            'reparacaoData' => 'Reparacao Data',
            'reparacaoDataConcluido' => 'Reparacao Data Concluido',
            'reparacaoDescricao' => 'Reparacao Descricao',
            'user_iduser' => 'User Iduser',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIduser()
    {
        return $this->hasOne(Userdata::className(), ['iduser' => 'user_iduser']);
    }
}
