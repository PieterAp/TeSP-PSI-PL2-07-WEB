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
     * @param string $userNomeProprio
     */
    public function setUserNomeProprio($userNomeProprio)
    {
        $this->userNomeProprio = $userNomeProprio;
    }

    /**
     * @param string $userApelido
     */
    public function setUserApelido($userApelido)
    {
        $this->userApelido = $userApelido;
    }

    /**
     * @param int $userNIF
     */
    public function setUserNIF($userNIF)
    {
        $this->userNIF = $userNIF;
    }

    /**
     * @param string $userDataNasc
     */
    public function setUserDataNasc($userDataNasc)
    {
        $this->userDataNasc = $userDataNasc;
    }

    /**
     * @param string $userEstado
     */
    public function setUserEstado($userEstado)
    {
        $this->userEstado = $userEstado;
    }

    /**
     * @param string $userMorada
     */
    public function setUserMorada($userMorada)
    {
        $this->userMorada = $userMorada;
    }

    /**
     * @param int $userVisibilidade
     */
    public function setUserVisibilidade($userVisibilidade)
    {
        $this->userVisibilidade = $userVisibilidade;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getUserNIF()
    {
        return $this->userNIF;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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
            ['userNIF', 'unique', 'message' => 'This NIF has already been taken.'],
            ['userNIF', 'integer'],
            ['userNIF', 'string', 'min' => 9, 'max' =>9],

            ['userDataNasc', 'trim'],
            ['userDataNasc', 'required'],
            ['userDataNasc', 'date', 'format' => 'php:Y-m-d'],
            ['userDataNasc', 'validateDates'],

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
    public function validateDates(){
        if ((date('Y-m-d') - $this->userDataNasc) < 12){
            $this->addError('userDataNasc','Higher than 12 years old');
        }
    }
}
