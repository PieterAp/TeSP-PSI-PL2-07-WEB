<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form of `common\models\Produto`.
 */
class ProdutoSearch extends Produto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idprodutos', 'produtoStock', 'categoria_child_id', 'produtoEstado'], 'integer'],
            [['produtoNome', 'produtoCodigo', 'produtoDataCriacao', 'produtoMarca', 'produtoDescricao1', 'produtoDescricao2', 'produtoDescricao3', 'produtoDescricao4', 'produtoDescricao5', 'produtoDescricao6', 'produtoDescricao7', 'produtoDescricao8', 'produtoDescricao9', 'produtoDescricao10', 'produtoImagem1', 'produtoImagem2', 'produtoImagem3', 'produtoImagem4'], 'safe'],
            [['produtoPreco'], 'number'],
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
        $query = Produto::find();

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
            'idprodutos' => $this->idprodutos,
            'produtoDataCriacao' => $this->produtoDataCriacao,
            'produtoStock' => $this->produtoStock,
            'produtoPreco' => $this->produtoPreco,
            'categoria_child_id' => $this->categoria_child_id,
            'produtoEstado' => $this->produtoEstado,
        ]);

        $query->andFilterWhere(['like', 'produtoNome', $this->produtoNome])
            ->andFilterWhere(['like', 'produtoCodigo', $this->produtoCodigo])
            ->andFilterWhere(['like', 'produtoMarca', $this->produtoMarca])
            ->andFilterWhere(['like', 'produtoDescricao1', $this->produtoDescricao1])
            ->andFilterWhere(['like', 'produtoDescricao2', $this->produtoDescricao2])
            ->andFilterWhere(['like', 'produtoDescricao3', $this->produtoDescricao3])
            ->andFilterWhere(['like', 'produtoDescricao4', $this->produtoDescricao4])
            ->andFilterWhere(['like', 'produtoDescricao5', $this->produtoDescricao5])
            ->andFilterWhere(['like', 'produtoDescricao6', $this->produtoDescricao6])
            ->andFilterWhere(['like', 'produtoDescricao7', $this->produtoDescricao7])
            ->andFilterWhere(['like', 'produtoDescricao8', $this->produtoDescricao8])
            ->andFilterWhere(['like', 'produtoDescricao9', $this->produtoDescricao9])
            ->andFilterWhere(['like', 'produtoDescricao10', $this->produtoDescricao10])
            ->andFilterWhere(['like', 'produtoImagem1', $this->produtoImagem1])
            ->andFilterWhere(['like', 'produtoImagem2', $this->produtoImagem2])
            ->andFilterWhere(['like', 'produtoImagem3', $this->produtoImagem3])
            ->andFilterWhere(['like', 'produtoImagem4', $this->produtoImagem4]);

        return $dataProvider;
    }
}
