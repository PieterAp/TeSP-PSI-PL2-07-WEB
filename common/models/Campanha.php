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



            ['campanhaDataFim', 'compare', 'compareAttribute' => 'campanhaDataInicio', 'operator' => '>', 'message' => 'Date End must be higher than Date Start'],
            ['campanhaDataInicio', 'validateDates'],

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

    /**
     * @return string
     */
    public function getCampanhaNome()
    {
        return $this->campanhaNome;
    }

    /**
     * @param string $campanhaNome
     */
    public function setCampanhaNome($campanhaNome)
    {
        $this->campanhaNome = $campanhaNome;
    }

    /**
     * @return string
     */
    public function getCampanhaDataInicio()
    {
        return $this->campanhaDataInicio;
    }

    /**
     * @param string $campanhaDataInicio
     */
    public function setCampanhaDataInicio($campanhaDataInicio)
    {
        $this->campanhaDataInicio = $campanhaDataInicio;
    }

    /**
     * @return string
     */
    public function getCampanhaDescricao()
    {
        return $this->campanhaDescricao;
    }

    /**
     * @param string $campanhaDescricao
     */
    public function setCampanhaDescricao($campanhaDescricao)
    {
        $this->campanhaDescricao = $campanhaDescricao;
    }

    /**
     * @return string
     */
    public function getCampanhaDataFim()
    {
        return $this->campanhaDataFim;
    }

    /**
     * @param string $campanhaDataFim
     */
    public function setCampanhaDataFim($campanhaDataFim)
    {
        $this->campanhaDataFim = $campanhaDataFim;
    }

    public function validateDates(){
        if (date('Y-m-d') > $this->campanhaDataInicio){
            $this->addError('campanhaDataInicio','Date Start must be higher than today date');
        }
    }
}
