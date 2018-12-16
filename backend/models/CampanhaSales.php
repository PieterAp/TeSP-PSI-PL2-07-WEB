<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use common\models\Userdata;
/**
 * Signup form
 */
class CampanhaSales extends Model
{
    public $campanhaNome;
    public $campanhaDataInicio;
    public $campanhaDataFim;
    public $campanhaDescricao;
    public $campanhaPercentagem;


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

            /*['campanhaPercentagem', 'required'],
            ['campanhaPercentagem', 'trim'],
            ['campanhaPercentagem', 'string', 'min' => '1', 'max' => '2'],*/

            ['campanhaDataFim', 'compare', 'compareAttribute' => 'campanhaDataInicio', 'operator' => '>', 'message' => 'Date End must be higher than Date Start'],
            ['campanhaDataInicio', 'validateDates'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'campanhaNome' => 'Sale name',
            'campanhaDataInicio' => 'Sale date start',
            'campanhaDescricao' => 'Sale description',
            'campanhaDataFim' => 'Sale date end',
            /*'campanhaPercentagem' => 'Sale %',*/
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function CampanhaValidate()
    {
        if (!$this->validate()) {
            return null;
        }
        return $this;
    }
    public function validateDates(){
        if (date('Y-m-d') > $this->campanhaDataInicio){
            $this->addError('campanhaDataInicio','Date Start must be higher than today date');
        }
    }
}
