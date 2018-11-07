<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "compra".
 *
 * @property int $idcompras
 * @property string $compraData
 * @property int $user_iduser
 * @property double $compraValor
 *
 * @property Userdata $userIduser
 * @property Compraproduto[] $compraprodutos
 * @property Produto[] $produtoIdprodutos
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compraData', 'user_iduser', 'compraValor'], 'required'],
            [['compraData'], 'safe'],
            [['user_iduser'], 'integer'],
            [['compraValor'], 'number'],
            [['user_iduser'], 'exist', 'skipOnError' => true, 'targetClass' => Userdata::className(), 'targetAttribute' => ['user_iduser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcompras' => 'Idcompras',
            'compraData' => 'Compra Data',
            'user_iduser' => 'User Iduser',
            'compraValor' => 'Compra Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIduser()
    {
        return $this->hasOne(Userdata::className(), ['iduser' => 'user_iduser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraprodutos()
    {
        return $this->hasMany(Compraproduto::className(), ['compra_idcompras' => 'idcompras']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoIdprodutos()
    {
        return $this->hasMany(Produto::className(), ['idprodutos' => 'produto_idprodutos'])->viaTable('compraproduto', ['compra_idcompras' => 'idcompras']);
    }
}
