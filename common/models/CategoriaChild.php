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
 * @property int $childEstado
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
            ['childNome', 'required'],
            ['childNome', 'trim'],
            ['childNome', 'string', 'max' => 25],

            ['childDescricao', 'trim'],
            ['childDescricao', 'string', 'max' => 128],

            ['categoria_idcategorias', 'required'],
            ['categoria_idcategorias', 'integer'],

            ['childEstado', 'integer'],
            ['childEstado', 'default', 'value' => 0],

            [['categoria_idcategorias'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_idcategorias' => 'idcategorias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idchild' => 'Sub-category ID',
            'childNome' => 'Sub-category Name',
            'childDescricao' => 'Sub-category Description',
            'categoria_idcategorias' => 'Categoria Idcategorias',
            'childEstado' => 'Status',
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

    /**
     * @return string
     */
    public function getChildNome()
    {
        return $this->childNome;
    }

    /**
     * @param string $childNome
     */
    public function setChildNome($childNome)
    {
        $this->childNome = $childNome;
    }

    /**
     * @return string
     */
    public function getChildDescricao()
    {
        return $this->childDescricao;
    }

    /**
     * @param string $childDescricao
     */
    public function setChildDescricao($childDescricao)
    {
        $this->childDescricao = $childDescricao;
    }

    /**
     * @return int
     */
    public function getChildEstado()
    {
        return $this->childEstado;
    }

    /**
     * @param int $childEstado
     */
    public function setChildEstado($childEstado)
    {
        $this->childEstado = $childEstado;
    }

    /**
     * @param int $categoria_idcategorias
     */
    public function setCategoriaIdcategorias($categoria_idcategorias)
    {
        $this->categoria_idcategorias = $categoria_idcategorias;
    }

}
