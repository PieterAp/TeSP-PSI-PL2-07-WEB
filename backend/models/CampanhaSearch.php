<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Campanha;

/**
 * CampanhaSearch represents the model behind the search form of `common\models\Campanha`.
 */
class CampanhaSearch extends Campanha
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCampanha'], 'integer'],
            [['campanhaNome', 'campanhaDataInicio', 'campanhaDescricao', 'campanhaDataFim'], 'safe'],
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
        $query = Campanha::find();

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
            'idCampanha' => $this->idCampanha,
            'campanhaDataInicio' => $this->campanhaDataInicio,
            'campanhaDataFim' => $this->campanhaDataFim,
        ]);

        $query->andFilterWhere(['like', 'campanhaNome', $this->campanhaNome])
            ->andFilterWhere(['like', 'campanhaDescricao', $this->campanhaDescricao]);

        return $dataProvider;
    }
}
