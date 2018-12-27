<?php

use yii\db\Migration;

class m181109_143951_create_table_produto extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%produto}}', [
            'idprodutos' => $this->primaryKey(),
            'produtoNome' => $this->string(45)->notNull(),
            'produtoCodigo' => $this->string(20)->notNull(),
            'produtoDataCriacao' => $this->dateTime()->notNull(),
            'produtoStock' => $this->integer()->notNull(),
            'produtoPreco' => $this->float()->notNull(),
            'produtoMarca' => $this->string(45)->notNull(),
            'produtoDescricao1' => $this->string(128),
            'produtoDescricao2' => $this->string(128),
            'produtoDescricao3' => $this->string(128),
            'produtoDescricao4' => $this->string(128),
            'produtoDescricao5' => $this->string(128),
            'produtoDescricao6' => $this->string(128),
            'produtoDescricao7' => $this->string(128),
            'produtoDescricao8' => $this->string(128),
            'produtoDescricao9' => $this->string(128),
            'produtoDescricao10' => $this->string(128),
            'categoria_child_id' => $this->integer()->notNull(),
            'produtoImagem1' => $this->string()->notNull(),
            'produtoImagem2' => $this->string(),
            'produtoImagem3' => $this->string(),
            'produtoImagem4' => $this->string(),
        ], $tableOptions);
        
        $this->createIndex('fk_produto_categoria1_idx', '{{%produto}}', 'categoria_child_id');
        $this->addForeignKey('fk_produto_categoria1', '{{%produto}}', 'categoria_child_id', '{{%categoria_child}}', 'idchild', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%produto}}');
    }
}
