<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria_child".
 *
 * @property int $idchild
 * @property string $childNome
 * @property string $childDescricao
 * @property int $categoria_idcategorias
 *
 * @property Categoria $categoriaIdcategorias
 * @property Produto[] $produtos
 */
class CategoriaChild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['childNome', 'categoria_idcategorias'], 'required'],
            [['categoria_idcategorias'], 'integer'],
            [['childNome', 'childDescricao'], 'string', 'max' => 255],
            [['categoria_idcategorias'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_idcategorias' => 'idcategorias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idchild' => 'Idchild',
            'childNome' => 'Child Nome',
            'childDescricao' => 'Child Descricao',
            'categoria_idcategorias' => 'Categoria Idcategorias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaIdcategorias()
    {
        return $this->hasOne(Categoria::className(), ['idcategorias' => 'categoria_idcategorias']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['categoria_child_id' => 'idchild']);
    }
}
