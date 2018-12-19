<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Userdata;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $userNomeProprio;
    public $userApelido;
    public $userNIF;
    public $userDataNasc;
    public $userMorada;
    public $email;
    public $password;
    public $user_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

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
            ['userDataNasc', 'validateDates'],

            ['userMorada', 'trim'],
            ['userMorada', 'required'],
            ['userMorada', 'string', 'min' => 9, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
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
            'userMorada' => 'Address',
            'user_id' => 'USER_ID',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->save(false);

        $userdata = new Userdata();
        $userdata->userNomeProprio = $this->userNomeProprio;
        $userdata->userApelido = $this->userApelido;
        $userdata->userNIF = $this->userNIF;
        $userdata->userDataNasc = $this->userDataNasc;
        $userdata->userMorada =$this->userMorada;
        $identity = User::findOne(['username' => $user->username]);
        $userdata->user_id =$identity->id;

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('cliente');
        $auth->assign($authorRole, $user->getId());

        $userdata->save(false);
        return $user;

    }
    public function validateDates(){
        $age = date("Y") - date("Y", strtotime($this->userDataNasc));
        if ($age < 12){
            $this->addError('userDataNasc','Must be at least 12 years old');
        }
    }
}
