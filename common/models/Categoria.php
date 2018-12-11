<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idcategorias
 * @property string $categoriaNome
 * @property string $categoriaDescricao
 *
 * @property Produto[] $produtos
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoriaNome'], 'required'],
            [['categoriaNome'], 'string', 'max' => 16],
            [['categoriaDescricao'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategorias' => 'Idcategorias',
            'categoriaNome' => 'Categoria Nome',
            'categoriaDescricao' => 'Categoria Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['categoria_idcategorias' => 'idcategorias']);
    }
}
