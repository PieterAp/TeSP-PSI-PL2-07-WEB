<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produtocampanha".
 *
 * @property int $produtos_idprodutos
 * @property int $campanha_idCampanha
 * @property int $campanhaPercentagem
 *
 * @property Campanha $campanhaIdCampanha
 * @property Produto $produtosIdprodutos
 */
class Produtocampanha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produtocampanha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produtos_idprodutos', 'campanha_idCampanha', 'campanhaPercentagem'], 'required'],
            [['produtos_idprodutos', 'campanha_idCampanha', 'campanhaPercentagem'], 'integer'],
            [['produtos_idprodutos', 'campanha_idCampanha'], 'unique', 'targetAttribute' => ['produtos_idprodutos', 'campanha_idCampanha']],
            [['campanha_idCampanha'], 'exist', 'skipOnError' => true, 'targetClass' => Campanha::className(), 'targetAttribute' => ['campanha_idCampanha' => 'idCampanha']],
            [['produtos_idprodutos'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produtos_idprodutos' => 'idprodutos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'produtos_idprodutos' => 'Produtos Idprodutos',
            'campanha_idCampanha' => 'Campanha Id Campanha',
            'campanhaPercentagem' => 'Campanha Percentagem',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanhaIdCampanha()
    {
        return $this->hasOne(Campanha::className(), ['idCampanha' => 'campanha_idCampanha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutosIdprodutos()
    {
        return $this->hasOne(Produto::className(), ['idprodutos' => 'produtos_idprodutos']);
    }
}
