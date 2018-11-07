<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $idprodutos
 * @property string $produtoNome
 * @property string $produtoCodigo
 * @property string $produtoDataCriacao
 * @property int $produtoStock
 * @property double $produtoPreco
 * @property string $produtoMarca
 * @property string $produtoDescricao1
 * @property string $produtoDescricao2
 * @property string $produtoDescricao3
 * @property string $produtoDescricao4
 * @property string $produtoDescricao5
 * @property string $produtoDescricao6
 * @property string $produtoDescricao7
 * @property string $produtoDescricao8
 * @property string $produtoDescricao9
 * @property string $produtoDescricao10
 * @property int $categoria_idcategorias
 * @property string $produtoImagem1
 * @property string $produtoImagem2
 * @property string $produtoImagem3
 * @property string $produtoImagem4
 *
 * @property Compraproduto[] $compraprodutos
 * @property Compra[] $compraIdcompras
 * @property Categoria $categoriaIdcategorias
 * @property Produtocampanha[] $produtocampanhas
 * @property Campanha[] $campanhaIdCampanhas
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produtoNome', 'produtoCodigo', 'produtoDataCriacao', 'produtoStock', 'produtoPreco', 'produtoMarca', 'categoria_idcategorias', 'produtoImagem1'], 'required'],
            [['produtoDataCriacao'], 'safe'],
            [['produtoStock', 'categoria_idcategorias'], 'integer'],
            [['produtoPreco'], 'number'],
            [['produtoNome', 'produtoImagem1', 'produtoImagem2', 'produtoImagem3', 'produtoImagem4'], 'string', 'max' => 45],
            [['produtoCodigo', 'produtoMarca'], 'string', 'max' => 16],
            [['produtoDescricao1', 'produtoDescricao2', 'produtoDescricao3', 'produtoDescricao4', 'produtoDescricao5', 'produtoDescricao6', 'produtoDescricao7', 'produtoDescricao8', 'produtoDescricao9', 'produtoDescricao10'], 'string', 'max' => 128],
            [['categoria_idcategorias'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_idcategorias' => 'idcategorias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprodutos' => 'Idprodutos',
            'produtoNome' => 'Produto Nome',
            'produtoCodigo' => 'Produto Codigo',
            'produtoDataCriacao' => 'Produto Data Criacao',
            'produtoStock' => 'Produto Stock',
            'produtoPreco' => 'Produto Preco',
            'produtoMarca' => 'Produto Marca',
            'produtoDescricao1' => 'Produto Descricao1',
            'produtoDescricao2' => 'Produto Descricao2',
            'produtoDescricao3' => 'Produto Descricao3',
            'produtoDescricao4' => 'Produto Descricao4',
            'produtoDescricao5' => 'Produto Descricao5',
            'produtoDescricao6' => 'Produto Descricao6',
            'produtoDescricao7' => 'Produto Descricao7',
            'produtoDescricao8' => 'Produto Descricao8',
            'produtoDescricao9' => 'Produto Descricao9',
            'produtoDescricao10' => 'Produto Descricao10',
            'categoria_idcategorias' => 'Categoria Idcategorias',
            'produtoImagem1' => 'Produto Imagem1',
            'produtoImagem2' => 'Produto Imagem2',
            'produtoImagem3' => 'Produto Imagem3',
            'produtoImagem4' => 'Produto Imagem4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraprodutos()
    {
        return $this->hasMany(Compraproduto::className(), ['produto_idprodutos' => 'idprodutos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraIdcompras()
    {
        return $this->hasMany(Compra::className(), ['idcompras' => 'compra_idcompras'])->viaTable('compraproduto', ['produto_idprodutos' => 'idprodutos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaIdcategorias()
    {
        return $this->hasOne(Categoria::className(), ['idcategorias' => 'categoria_idcategorias']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutocampanhas()
    {
        return $this->hasMany(Produtocampanha::className(), ['produtos_idprodutos' => 'idprodutos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanhaIdCampanhas()
    {
        return $this->hasMany(Campanha::className(), ['idCampanha' => 'campanha_idCampanha'])->viaTable('produtocampanha', ['produtos_idprodutos' => 'idprodutos']);
    }
}
