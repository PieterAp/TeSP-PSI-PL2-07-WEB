<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CategoriaChild;

/**
 * CategoriaChildSearch represents the model behind the search form of `common\models\CategoriaChild`.
 */
class CategoriaChildSearch extends CategoriaChild
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idchild', 'categoria_idcategorias'], 'integer'],
            [['childNome', 'childDescricao'], 'safe'],
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
        $query = CategoriaChild::find();

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
            'idchild' => $this->idchild,
            'categoria_idcategorias' => $this->categoria_idcategorias,
        ]);

        $query->andFilterWhere(['like', 'childNome', $this->childNome])
            ->andFilterWhere(['like', 'childDescricao', $this->childDescricao]);

        return $dataProvider;
    }
}
