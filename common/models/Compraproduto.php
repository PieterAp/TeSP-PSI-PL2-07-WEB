<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "compraproduto".
 *
 * @property int $compra_idcompras
 * @property int $produto_idprodutos
 *
 * @property Compra $compraIdcompras
 * @property Produto $produtoIdprodutos
 */
class Compraproduto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compraproduto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compra_idcompras', 'produto_idprodutos'], 'required'],
            [['compra_idcompras', 'produto_idprodutos'], 'integer'],
            [['compra_idcompras', 'produto_idprodutos'], 'unique', 'targetAttribute' => ['compra_idcompras', 'produto_idprodutos']],
            [['compra_idcompras'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::className(), 'targetAttribute' => ['compra_idcompras' => 'idcompras']],
            [['produto_idprodutos'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_idprodutos' => 'idprodutos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'compra_idcompras' => 'Compra Idcompras',
            'produto_idprodutos' => 'Produto Idprodutos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraIdcompras()
    {
        return $this->hasOne(Compra::className(), ['idcompras' => 'compra_idcompras']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoIdprodutos()
    {
        return $this->hasOne(Produto::className(), ['idprodutos' => 'produto_idprodutos']);
    }
}
