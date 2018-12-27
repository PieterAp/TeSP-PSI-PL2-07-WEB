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
            ['categoriaNome', 'required'],
            ['categoriaNome', 'trim'],
            ['categoriaNome', 'string', 'min' => 2, 'max' => 25],

            ['categoriaEstado', 'integer'],
            ['categoriaEstado', 'default', 'value' => 0],

            ['categoriaDescricao', 'trim'],
            ['categoriaDescricao', 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategorias' => 'ID',
            'categoriaNome' => 'Name',
            'categoriaDescricao' => 'Description',
            'categoriaEstado' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaChildren()
    {
        return $this->hasMany(CategoriaChild::className(), ['categoria_idcategorias' => 'idcategorias']);
    }

    /**
     * @return string
     */
    public function getCategoriaNome()
    {
        return $this->categoriaNome;
    }

    /**
     * @param string $categoriaNome
     */
    public function setCategoriaNome($categoriaNome)
    {
        $this->categoriaNome = $categoriaNome;
    }

    /**
     * @return string
     */
    public function getCategoriaDescricao()
    {
        return $this->categoriaDescricao;
    }

    /**
     * @param string $categoriaDescricao
     */
    public function setCategoriaDescricao($categoriaDescricao)
    {
        $this->categoriaDescricao = $categoriaDescricao;
    }

    /**
     * @return int
     */
    public function getCategoriaEstado()
    {
        return $this->categoriaEstado;
    }

    /**
     * @param int $categoriaEstado
     */
    public function setCategoriaEstado($categoriaEstado)
    {
        $this->categoriaEstado = $categoriaEstado;
    }




}
