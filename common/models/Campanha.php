<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "campanha".
 *
 * @property int $idCampanha
 * @property string $campanhaNome
 * @property string $campanhaDataInicio
 * @property string $campanhaDescricao
 * @property string $campanhaDataFim
 *
 * @property Produtocampanha[] $produtocampanhas
 * @property Produto[] $produtosIdprodutos
 */
class Campanha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campanha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['campanhaNome', 'campanhaDataInicio', 'campanhaDataFim'], 'required'],
            ['campanhaDataInicio', 'date', 'format' => 'php:Y-m-d'],
            ['campanhaDataFim', 'date', 'format' => 'php:Y-m-d'],

            [['campanhaDataInicio', 'campanhaDataFim'], 'safe'],
            [['campanhaNome'], 'string', 'max' => 45],
            [['campanhaDescricao'], 'string', 'max' => 128],



            ['campanhaDataInicio', 'compare', 'compareAttribute' => 'campanhaDataFim', 'operator' => '<', 'message' => 'Date End must be higher than Date Start'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCampanha' => 'Sale id',
            'campanhaNome' => 'Sale name',
            'campanhaDataInicio' => 'Sale date start',
            'campanhaDescricao' => 'Sale description',
            'campanhaDataFim' => 'Sale date end',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutocampanhas()
    {
        return $this->hasMany(Produtocampanha::className(), ['campanha_idCampanha' => 'idCampanha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutosIdprodutos()
    {
        return $this->hasMany(Produto::className(), ['idprodutos' => 'produtos_idprodutos'])->viaTable('produtocampanha', ['campanha_idCampanha' => 'idCampanha']);
    }
    public function CampanhaValidate()
    {
        if (!$this->validate()) {
            return null;
        }
        return $this;
    }
}
