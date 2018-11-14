<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userdata".
 *
 * @property int $iduser
 * @property string $userNomeProprio
 * @property string $userApelido
 * @property int $userNIF
 * @property string $userDataNasc
 * @property string $userEstado
 * @property string $userMorada
 * @property int $userVisibilidade
 * @property int $user_id
 *
 * @property Compra[] $compras
 * @property Reparacao[] $reparacaos
 * @property User $user
 */
class Userdata extends \yii\db\ActiveRecord
{
    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userdata';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userNomeProprio', 'userApelido', 'user_id'], 'required'],
            [['userNIF', 'user_id'], 'integer'],
            [['userDataNasc'], 'safe'],
            [['userEstado'], 'string'],
            [['userNomeProprio', 'userApelido'], 'string', 'max' => 16],
            [['userMorada'], 'string', 'max' => 255],
            [['userVisibilidade'], 'integer'],

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],


            ['userNomeProprio', 'trim'],
            ['userNomeProprio', 'required'],
            ['userNomeProprio', 'string', 'min' => 3, 'max' => 16],

            ['userApelido', 'trim'],
            ['userApelido', 'required'],
            ['userApelido', 'string', 'min' => 3, 'max' => 16],

            ['userNIF', 'trim'],
            ['userNIF', 'required'],
            ['userNIF', 'unique', 'targetClass' => '\common\models\Userdata', 'message' => 'This NIF has already been taken.'],
            ['userNIF', 'integer'],
            ['userNIF', 'string', 'min' => 9, 'max' =>9],

            ['userDataNasc', 'trim'],
            ['userDataNasc', 'required'],
            ['userDataNasc', 'date', 'format' => 'php:Y-m-d'],

            ['userMorada', 'trim'],
            ['userMorada', 'required'],
            ['userMorada', 'string', 'min' => 9, 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduser' => 'ID',
            'userNomeProprio' => 'First name',
            'userApelido' => 'Last name',   
            'userNIF' => 'NIF',
            'userDataNasc' => 'Birthday',
            'userEstado' => 'Estate',
            'userMorada' => 'Adress',
            'user_id' => 'USER_ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['user_iduser' => 'iduser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReparacaos()
    {
        return $this->hasMany(Reparacao::className(), ['user_iduser' => 'iduser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
