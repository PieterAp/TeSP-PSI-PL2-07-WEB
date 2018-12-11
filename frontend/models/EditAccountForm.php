<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Userdata;
/**
 * Signup form
 */
class EditAccountForm extends Model
{
    public $username;
    public $userNomeProprio;
    public $userApelido;
    public $userNIF;
    public $userDataNasc;
    public $userMorada;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['userNomeProprio', 'trim'],
            ['userNomeProprio', 'required'],
            ['userNomeProprio', 'string', 'min' => 3, 'max' => 16],

            ['userApelido', 'trim'],
            ['userApelido', 'required'],
            ['userApelido', 'string', 'min' => 3, 'max' => 16],
            
            ['userNIF', 'integer'],
            ['userNIF', 'string', 'min' => 9, 'max' =>9],

            ['userDataNasc', 'trim'],
            ['userDataNasc', 'required'],
            ['userDataNasc', 'date', 'format' => 'php:Y-m-d'],
            ['userDataNasc', 'validateDates'],

            ['userMorada', 'trim'],
            ['userMorada', 'required'],
            ['userMorada', 'string', 'min' => 9, 'max' => 255],
            ['password', 'string', 'min' => 6],
        ];
    }
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
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function editAccount()
    {

        if (!$this->validate()) {
            return null;
        }
        return $this;

    }
    public function validateDates(){
        if ((date('Y-m-d') - $this->userDataNasc) < 12){
            $this->addError('userDataNasc','Must be at least 12 years old');
        }
    }
}
