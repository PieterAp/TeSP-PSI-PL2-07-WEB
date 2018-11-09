<?php

use yii\db\Migration;

class m181109_143949_create_table_produto extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%produto}}', [
            'idprodutos' => $this->integer()->notNull(),
            'produtoNome' => $this->string()->notNull(),
            'produtoCodigo' => $this->string()->notNull(),
            'produtoDataCriacao' => $this->dateTime()->notNull(),
            'produtoStock' => $this->integer()->notNull(),
            'produtoPreco' => $this->float()->notNull(),
            'produtoMarca' => $this->string()->notNull(),
            'produtoDescricao1' => $this->string(),
            'produtoDescricao2' => $this->string(),
            'produtoDescricao3' => $this->string(),
            'produtoDescricao4' => $this->string(),
            'produtoDescricao5' => $this->string(),
            'produtoDescricao6' => $this->string(),
            'produtoDescricao7' => $this->string(),
            'produtoDescricao8' => $this->string(),
            'produtoDescricao9' => $this->string(),
            'produtoDescricao10' => $this->string(),
            'categoria_idcategorias' => $this->integer()->notNull(),
            'produtoImagem1' => $this->string()->notNull(),
            'produtoImagem2' => $this->string(),
            'produtoImagem3' => $this->string(),
            'produtoImagem4' => $this->string(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%produto}}', ['idprodutos', 'categoria_idcategorias']);
        $this->createIndex('fk_produto_categoria1_idx', '{{%produto}}', 'categoria_idcategorias');
        $this->addForeignKey('fk_produto_categoria1', '{{%produto}}', 'categoria_idcategorias', '{{%categoria}}', 'idcategorias', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%produto}}');
    }
}
