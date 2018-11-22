<?php

use yii\db\Migration;

class m181109_143954_create_table_compraproduto extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%compraproduto}}', [
            'compra_idcompras' => $this->integer()->notNull(),
            'produto_idprodutos' => $this->integer()->notNull(),
            'produto_preco' => $this->decimal(10,2)->notNull(),
        ], $tableOptions);
        
        $this->createIndex('fk_compra_has_produto_produto1_idx', '{{%compraproduto}}', 'produto_idprodutos');
        $this->createIndex('fk_compra_has_produto_compra1_idx', '{{%compraproduto}}', 'compra_idcompras');
        $this->addForeignKey('fk_compra_has_produto_compra1', '{{%compraproduto}}', 'compra_idcompras', '{{%compra}}', 'idcompras', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_compra_has_produto_produto1', '{{%compraproduto}}', 'produto_idprodutos', '{{%produto}}', 'idprodutos', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%compraproduto}}');
    }
}
