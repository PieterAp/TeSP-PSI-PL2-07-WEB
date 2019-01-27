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
            ['reparacaoNome', 'required'],
            ['reparacaoNome', 'trim'],
            ['reparacaoNome', 'string', 'max' => 45],

            ['reparacaoEstado', 'string'],
            ['reparacaoEstado', 'trim'],

            ['reparacaoNumero', 'required'],
            ['reparacaoNumero', 'integer'],

            ['reparacaoData', 'required'],
            ['reparacaoData', 'safe'],
            ['reparacaoData', 'datetime', 'format' => 'php:Y-m-d H:i:s'],

            ['reparacaoDataConcluido', 'required'],
            ['reparacaoDataConcluido', 'safe'],
            ['reparacaoDataConcluido', 'datetime', 'format' => 'php:Y-m-d'],

            ['reparacaoDescricao', 'required'],
            ['reparacaoDescricao', 'trim'],
            ['reparacaoDescricao', 'string', 'max' => 128],

            //['user_iduser', 'required'],
            ['user_iduser', 'integer'],
            [['user_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => Userdata::className(), 'targetAttribute' => ['user_iduser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idreparacao' => 'Repair ID',
            'reparacaoNome' => 'Repair product name',
            'reparacaoEstado' => 'Repair status',
            'reparacaoNumero' => 'Repair unique id',
            'reparacaoData' => 'Repair start date',
            'reparacaoDataConcluido' => 'Repair finish date',
            'reparacaoDescricao' => 'Repair description',
            'user_iduser' => 'User ID',
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
