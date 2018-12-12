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
 * @property int $categoria_child_id
 * @property string $produtoImagem1
 * @property string $produtoImagem2
 * @property string $produtoImagem3
 * @property string $produtoImagem4
 * @property int $produtoEstado
 *
 * @property Compraproduto[] $compraprodutos
 * @property CategoriaChild $categoriaChild
 * @property Produtocampanha[] $produtocampanhas
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
            [['produtoNome', 'produtoCodigo', 'produtoDataCriacao', 'produtoStock', 'produtoPreco', 'produtoMarca', 'categoria_child_id', 'produtoImagem1'], 'required'],
            [['produtoDataCriacao'], 'safe'],
            [['produtoStock', 'categoria_child_id', 'produtoEstado'], 'integer'],
            [['produtoPreco'], 'number'],
            [['produtoNome', 'produtoCodigo', 'produtoMarca', 'produtoDescricao1', 'produtoDescricao2', 'produtoDescricao3', 'produtoDescricao4', 'produtoDescricao5', 'produtoDescricao6', 'produtoDescricao7', 'produtoDescricao8', 'produtoDescricao9', 'produtoDescricao10', 'produtoImagem1', 'produtoImagem2', 'produtoImagem3', 'produtoImagem4'], 'string', 'max' => 255],
            [['categoria_child_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaChild::className(), 'targetAttribute' => ['categoria_child_id' => 'idchild']],
            [['produtoImagem1', 'produtoImagem2', 'produtoImagem3', 'produtoImagem4'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 2097152],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprodutos' => 'Product ID',
            'produtoNome' => 'Name',
            'produtoCodigo' => 'BarCode',
            'produtoStock' => 'Stock',
            'produtoPreco' => 'Price',
            'produtoMarca' => 'Brand',
            'produtoDataCriacao' => 'Created at',
            'produtoDescricao1' => 'Description - line 1',
            'produtoDescricao2' => 'Description - line 2',
            'produtoDescricao3' => 'Description - line 3',
            'produtoDescricao4' => 'Description - line 4',
            'produtoDescricao5' => 'Description - line 5',
            'produtoDescricao6' => 'Description - line 6',
            'produtoDescricao7' => 'Description - line 7',
            'produtoDescricao8' => 'Description - line 8',
            'produtoDescricao9' => 'Description - line 9',
            'produtoDescricao10' => 'Description - line 10',
            'categoria_child_id' => 'Belonging to Sub-category',
            'produtoImagem1' => 'Image 1',
            'produtoImagem2' => 'Image 2',
            'produtoImagem3' => 'Image 3',
            'produtoImagem4' => 'Image 4',
            'produtoEstado' => 'Product visibility',
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
    public function getCategoriaChild()
    {
        return $this->hasOne(CategoriaChild::className(), ['idchild' => 'categoria_child_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutocampanhas()
    {
        return $this->hasMany(Produtocampanha::className(), ['produtos_idprodutos' => 'idprodutos']);
    }
}
