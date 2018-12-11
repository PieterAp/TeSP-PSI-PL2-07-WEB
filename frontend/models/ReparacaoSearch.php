<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reparacao;

/**
 * ReparacaoSearch represents the model behind the search form of `common\models\Reparacao`.
 */
class ReparacaoSearch extends Reparacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idreparacao', 'reparacaoNumero', 'user_iduser'], 'integer'],
            [['reparacaoNome', 'reparacaoEstado', 'reparacaoData', 'reparacaoDataConcluido', 'reparacaoDescricao'], 'safe'],
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
        $query = Reparacao::find();

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
            'idreparacao' => $this->idreparacao,
            'reparacaoNumero' => $this->reparacaoNumero,
            'reparacaoData' => $this->reparacaoData,
            'reparacaoDataConcluido' => $this->reparacaoDataConcluido,
            'user_iduser' => $this->user_iduser,
        ]);

        $query->andFilterWhere(['like', 'reparacaoNome', $this->reparacaoNome])
            ->andFilterWhere(['like', 'reparacaoEstado', $this->reparacaoEstado])
            ->andFilterWhere(['like', 'reparacaoDescricao', $this->reparacaoDescricao]);

        return $dataProvider;
    }
}
