<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idcategorias
 * @property string $categoriaNome
 * @property string $categoriaDescricao
 * @property int $categoriaEstado
 *
 * @property CategoriaChild[] $categoriaChildren
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
            [['categoriaEstado'], 'integer'],
            [['categoriaNome', 'categoriaDescricao'], 'string', 'max' => 255],
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
            'categoriaEstado' => 'Categoria Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaChildren()
    {
        return $this->hasMany(CategoriaChild::className(), ['categoria_idcategorias' => 'idcategorias']);
    }
}
