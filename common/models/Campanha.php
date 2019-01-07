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
     * Function will come in action after model gets saved
     * @param bool $insert
     * @param array $changedAttributes
     */

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $id = $this->idCampanha;
        $nome = $this->campanhaNome;
        $dataInicio = $this->campanhaDataInicio;
        $descricao = $this->campanhaDescricao;
        $dataFim = $this->campanhaDataFim;

        $myObj = new \stdClass();
        $myObj->id = $id;
        $myObj->nome = $nome;
        $myObj->dataInicio = $dataInicio;
        $myObj->descricao = $descricao;
        $myObj->dataFim = $dataFim;

        $myJSON = json_encode($myObj);

        if($insert)
        {
            $this->FazPublish('INSERT',$myJSON);
        }
        else
        {
            $this->FazPublish('UPDATE',$myJSON);
        }
    }


    /**
     * Function will come in action after model gets deleted
     */
    public function afterDelete()
    {
        parent::afterDelete();

        $camp_id = $this->idCampanha;
        $myObj = new \stdClass();
        $myObj->id = $camp_id;
        $myJSON = json_encode($myObj);

        $this->FazPublish('DELETE', $myJSON);
    }

    /**
     * Function will publish a message to a broker channel of Mosquitto MQTT
     */

    public function FazPublish($canal, $msg)
    {
        $server = "127.0.0.1";
        $port = 1883;
        $username = "";
        $password = "";
        $client_id = "phpMQTT-publisher";
        $mqtt = new \backend\mosquitto\phpMQTT($server, $port, $client_id);

        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else
        {
            file_put_contents("debug.output","Time out!");
        }
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
