<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
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
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],

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

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
