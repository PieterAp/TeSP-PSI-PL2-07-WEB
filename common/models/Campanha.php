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
            [['campanhaNome', 'campanhaDataInicio', 'campanhaDescricao', 'campanhaDataFim'], 'required'],
            [['campanhaDataInicio', 'campanhaDataFim'], 'safe'],
            [['campanhaNome'], 'string', 'max' => 45],
            [['campanhaDescricao'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCampanha' => 'Id Campanha',
            'campanhaNome' => 'Campanha Nome',
            'campanhaDataInicio' => 'Campanha Data Inicio',
            'campanhaDescricao' => 'Campanha Descricao',
            'campanhaDataFim' => 'Campanha Data Fim',
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
}
