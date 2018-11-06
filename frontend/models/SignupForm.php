<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model

{
    public $username;
    public $firstname;
    public $lastname;
    public $NIF;
    public $dataNasc;
    public $morada;
    public $email;
    public $password;


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

            ['firstname', 'trim'],
            ['firstname', 'required'],
            ['firstname', 'string', 'min' => 3, 'max' => 16],

            ['lastname', 'trim'],
            ['lastname', 'required'],
            ['lastname', 'string', 'min' => 3, 'max' => 16],

            ['NIF', 'trim'],
            ['NIF', 'required'],
            ['NIF', 'number', 'min' => 9, 'max' => 9],

            ['dataNasc', 'trim'],
            ['dataNasc', 'required'],
            ['dataNasc', 'date', 'format' => 'php:Y-m-d'],

            ['morada', 'trim'],
            ['morada', 'required'],
            ['morada', 'string', 'min' => 9, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            
            $user = new User();
            $userData = new userData();
            
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);

            $userData->firstname = ($this->firstname);
            $userData->lastname = ($this->lastname);
            $userData->NIF = ($this->NIF);
            $userData->dataNasc = ($this->dataNasc);
            $userData->morada = ($this->dataNasc);
            $userData->save();

            $user->generateAuthKey();
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('cliente');
            $auth->assign($authorRole, $user->getId());
            return $user->save() ? $user : null;

        }
        return null;
    }
}
