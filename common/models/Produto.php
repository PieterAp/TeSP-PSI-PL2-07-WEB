<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $idprodutos
 * @property string $produtoNome
 * @property string $produtoCodigo
 * @property string $produtoDataCriacao
 * @property int $produtoStock
 * @property double $produtoPreco
 * @property string $produtoMarca
 * @property string $produtoDescricao1
 * @property string $produtoDescricao2
 * @property string $produtoDescricao3
 * @property string $produtoDescricao4
 * @property string $produtoDescricao5
 * @property string $produtoDescricao6
 * @property string $produtoDescricao7
 * @property string $produtoDescricao8
 * @property string $produtoDescricao9
 * @property string $produtoDescricao10
 * @property int $categoria_child_id
 * @property string $produtoImagem1
 * @property string $produtoImagem2
 * @property string $produtoImagem3
 * @property string $produtoImagem4
 * @property int $produtoEstado
 *
 * @property Compraproduto[] $compraprodutos
 * @property CategoriaChild $categoriaChild
 * @property Produtocampanha[] $produtocampanhas
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['produtoNome', 'required'],
            ['produtoNome', 'trim'],
            ['produtoNome', 'string', 'max' => 45],

            ['produtoCodigo', 'required'],
            ['produtoCodigo', 'trim'],
            ['produtoCodigo', 'string', 'max' => 20],

            ['produtoDataCriacao', 'required'],
            ['produtoDataCriacao', 'safe'],
            ['produtoDataCriacao', 'datetime', 'format' => 'php:Y-m-d H:i:s'],

            ['produtoStock', 'required'],
            ['produtoStock', 'integer'],

            ['produtoPreco', 'required'],
            ['produtoPreco', 'number'],

            ['produtoMarca', 'required'],
            ['produtoMarca', 'trim'],
            ['produtoMarca', 'string', 'max' => 45],

            [['produtoDescricao1', 'produtoDescricao2', 'produtoDescricao3', 'produtoDescricao4', 'produtoDescricao5', 'produtoDescricao6', 'produtoDescricao7', 'produtoDescricao8', 'produtoDescricao9', 'produtoDescricao10'], 'string', 'max' => 128],

            ['categoria_child_id', 'required'],
            ['categoria_child_id', 'integer'],
            ['categoria_child_id', 'exist', 'skipOnError' => true, 'targetClass' => CategoriaChild::className(), 'targetAttribute' => ['categoria_child_id' => 'idchild']],

            ['produtoImagem1', 'required', 'on' => 'create'],
            [['produtoImagem1', 'produtoImagem2', 'produtoImagem3', 'produtoImagem4'], 'file', 'extensions' => 'png, jpg, gif, jpeg', 'maxSize' => 2097152],

            ['produtoEstado', 'integer'],
            ['produtoEstado', 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprodutos' => 'Product ID',
            'produtoNome' => 'Name',
            'produtoCodigo' => 'BarCode',
            'produtoStock' => 'Stock',
            'produtoPreco' => 'Price',
            'produtoMarca' => 'Brand',
            'produtoDataCriacao' => 'Created at',
            'produtoDescricao1' => 'Description - line 1',
            'produtoDescricao2' => 'Description - line 2',
            'produtoDescricao3' => 'Description - line 3',
            'produtoDescricao4' => 'Description - line 4',
            'produtoDescricao5' => 'Description - line 5',
            'produtoDescricao6' => 'Description - line 6',
            'produtoDescricao7' => 'Description - line 7',
            'produtoDescricao8' => 'Description - line 8',
            'produtoDescricao9' => 'Description - line 9',
            'produtoDescricao10' => 'Description - line 10',
            'categoria_child_id' => 'Belonging to Sub-category',
            'produtoImagem1' => 'Image 1',
            'produtoImagem2' => 'Image 2',
            'produtoImagem3' => 'Image 3',
            'produtoImagem4' => 'Image 4',
            'produtoEstado' => 'Product visibility',
        ];
    }


    /**
     * Function will come in action after model gets saved
     * @param bool $insert
     * @param array $changedAttributes
     */
    /*
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $id = $this->idprodutos;
        $nome = $this->produtoNome;
        $codigo = $this->produtoCodigo;
        $dataCricao = $this->produtoDataCriacao;
        $stock = $this->produtoStock;
        $preco = $this->produtoPreco;
        $marca = $this->produtoMarca;
        $descricao1 = $this->produtoDescricao1;
        $descricao2 = $this->produtoDescricao2;
        $descricao3 = $this->produtoDescricao3;
        $descricao4 = $this->produtoDescricao4;
        $descricao5 = $this->produtoDescricao5;
        $descricao6 = $this->produtoDescricao6;
        $descricao7 = $this->produtoDescricao7;
        $descricao8 = $this->produtoDescricao8;
        $descricao9 = $this->produtoDescricao9;
        $descricao10 = $this->produtoDescricao10;
        $categoriaChild = $this->categoria_child_id;
        $imagem1 = $this->produtoImagem1;
        $imagem2 = $this->produtoImagem2;
        $imagem3 = $this->produtoImagem3;
        $imagem4 = $this->produtoImagem4;
        $estado = $this->produtoEstado;

        $myObj = new \stdClass();
        $myObj->id = $id;
        $myObj->nome = $nome;
        $myObj->codigo = $codigo;
        $myObj->dataCriacao = $dataCricao;
        $myObj->stock = $stock;
        $myObj->preco = $preco;
        $myObj->marca = $marca;
        $myObj->descricao1 = $descricao1;
        $myObj->descricao2 = $descricao2;
        $myObj->descricao3 = $descricao3;
        $myObj->descricao4 = $descricao4;
        $myObj->descricao5 = $descricao5;
        $myObj->descricao6 = $descricao6;
        $myObj->descricao7 = $descricao7;
        $myObj->descricao8 = $descricao8;
        $myObj->descricao9 = $descricao9;
        $myObj->descricao10 = $descricao10;
        $myObj->categoriaChild = $categoriaChild;
        $myObj->imagem1 = $imagem1;
        $myObj->imagem2 = $imagem2;
        $myObj->imagem3 = $imagem3;
        $myObj->imagem4 = $imagem4;
        $myObj->estado = $estado;

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
    */

    /**
     * Function will come in action after model gets deleted
     */
    /*
    public function afterDelete()
    {
        parent::afterDelete();

        $cat_id = $this->idprodutos;
        $myObj = new \stdClass();
        $myObj->id = $cat_id;
        $myJSON = json_encode($myObj);

        $this->FazPublish('DELETE', $myJSON);
    }
    */

    /**
     * Function will publish a message to a broker channel of Mosquitto MQTT
     */
    /*
    public function FazPublish($canal, $msg)
    {
        require("../../mosquitto/phpMQTT.php");

        $server = "127.0.0.1";
        $port = 1883;
        $username = "";
        $password = "";
        $client_id = "phpMQTT-publisher";
        $mqtt = new \app\mosquitto\phpMQTT($server, $port, $client_id);

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
    */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraprodutos()
    {
        return $this->hasMany(Compraproduto::className(), ['produto_idprodutos' => 'idprodutos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaChild()
    {
        return $this->hasOne(CategoriaChild::className(), ['idchild' => 'categoria_child_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutocampanhas()
    {
        return $this->hasMany(Produtocampanha::className(), ['produtos_idprodutos' => 'idprodutos']);
    }

    /**
     * @return string
     */
    public function getProdutoNome()
    {
        return $this->produtoNome;
    }

    /**
     * @param string $produtoNome
     */
    public function setProdutoNome($produtoNome)
    {
        $this->produtoNome = $produtoNome;
    }

    /**
     * @return string
     */
    public function getProdutoCodigo()
    {
        return $this->produtoCodigo;
    }

    /**
     * @param string $produtoCodigo
     */
    public function setProdutoCodigo($produtoCodigo)
    {
        $this->produtoCodigo = $produtoCodigo;
    }

    /**
     * @return string
     */
    public function getProdutoDataCriacao()
    {
        return $this->produtoDataCriacao;
    }

    /**
     * @param string $produtoDataCriacao
     */
    public function setProdutoDataCriacao($produtoDataCriacao)
    {
        $this->produtoDataCriacao = $produtoDataCriacao;
    }

    /**
     * @return int
     */
    public function getProdutoStock()
    {
        return $this->produtoStock;
    }

    /**
     * @param int $produtoStock
     */
    public function setProdutoStock($produtoStock)
    {
        $this->produtoStock = $produtoStock;
    }

    /**
     * @return float
     */
    public function getProdutoPreco()
    {
        return $this->produtoPreco;
    }

    /**
     * @param float $produtoPreco
     */
    public function setProdutoPreco($produtoPreco)
    {
        $this->produtoPreco = $produtoPreco;
    }

    /**
     * @return string
     */
    public function getProdutoMarca()
    {
        return $this->produtoMarca;
    }

    /**
     * @param string $produtoMarca
     */
    public function setProdutoMarca($produtoMarca)
    {
        $this->produtoMarca = $produtoMarca;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao1()
    {
        return $this->produtoDescricao1;
    }

    /**
     * @param string $produtoDescricao1
     */
    public function setProdutoDescricao1($produtoDescricao1)
    {
        $this->produtoDescricao1 = $produtoDescricao1;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao2()
    {
        return $this->produtoDescricao2;
    }

    /**
     * @param string $produtoDescricao2
     */
    public function setProdutoDescricao2($produtoDescricao2)
    {
        $this->produtoDescricao2 = $produtoDescricao2;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao3()
    {
        return $this->produtoDescricao3;
    }

    /**
     * @param string $produtoDescricao3
     */
    public function setProdutoDescricao3($produtoDescricao3)
    {
        $this->produtoDescricao3 = $produtoDescricao3;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao4()
    {
        return $this->produtoDescricao4;
    }

    /**
     * @param string $produtoDescricao4
     */
    public function setProdutoDescricao4($produtoDescricao4)
    {
        $this->produtoDescricao4 = $produtoDescricao4;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao5()
    {
        return $this->produtoDescricao5;
    }

    /**
     * @param string $produtoDescricao5
     */
    public function setProdutoDescricao5($produtoDescricao5)
    {
        $this->produtoDescricao5 = $produtoDescricao5;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao6()
    {
        return $this->produtoDescricao6;
    }

    /**
     * @param string $produtoDescricao6
     */
    public function setProdutoDescricao6($produtoDescricao6)
    {
        $this->produtoDescricao6 = $produtoDescricao6;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao7()
    {
        return $this->produtoDescricao7;
    }

    /**
     * @param string $produtoDescricao7
     */
    public function setProdutoDescricao7($produtoDescricao7)
    {
        $this->produtoDescricao7 = $produtoDescricao7;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao8()
    {
        return $this->produtoDescricao8;
    }

    /**
     * @param string $produtoDescricao8
     */
    public function setProdutoDescricao8($produtoDescricao8)
    {
        $this->produtoDescricao8 = $produtoDescricao8;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao9()
    {
        return $this->produtoDescricao9;
    }

    /**
     * @param string $produtoDescricao9
     */
    public function setProdutoDescricao9($produtoDescricao9)
    {
        $this->produtoDescricao9 = $produtoDescricao9;
    }

    /**
     * @return string
     */
    public function getProdutoDescricao10()
    {
        return $this->produtoDescricao10;
    }

    /**
     * @param string $produtoDescricao10
     */
    public function setProdutoDescricao10($produtoDescricao10)
    {
        $this->produtoDescricao10 = $produtoDescricao10;
    }

    /**
     * @return int
     */
    public function getCategoriaChildId()
    {
        return $this->categoria_child_id;
    }

    /**
     * @param int $categoria_child_id
     */
    public function setCategoriaChildId($categoria_child_id)
    {
        $this->categoria_child_id = $categoria_child_id;
    }

    /**
     * @return string
     */
    public function getProdutoImagem1()
    {
        return $this->produtoImagem1;
    }

    /**
     * @param string $produtoImagem1
     */
    public function setProdutoImagem1($produtoImagem1)
    {
        $this->produtoImagem1 = $produtoImagem1;
    }

    /**
     * @return string
     */
    public function getProdutoImagem2()
    {
        return $this->produtoImagem2;
    }

    /**
     * @param string $produtoImagem2
     */
    public function setProdutoImagem2($produtoImagem2)
    {
        $this->produtoImagem2 = $produtoImagem2;
    }

    /**
     * @return string
     */
    public function getProdutoImagem3()
    {
        return $this->produtoImagem3;
    }

    /**
     * @param string $produtoImagem3
     */
    public function setProdutoImagem3($produtoImagem3)
    {
        $this->produtoImagem3 = $produtoImagem3;
    }

    /**
     * @return string
     */
    public function getProdutoImagem4()
    {
        return $this->produtoImagem4;
    }

    /**
     * @param string $produtoImagem4
     */
    public function setProdutoImagem4($produtoImagem4)
    {
        $this->produtoImagem4 = $produtoImagem4;
    }

    /**
     * @return int
     */
    public function getProdutoEstado()
    {
        return $this->produtoEstado;
    }

    /**
     * @param int $produtoEstado
     */
    public function setProdutoEstado($produtoEstado)
    {
        $this->produtoEstado = $produtoEstado;
    }
}
