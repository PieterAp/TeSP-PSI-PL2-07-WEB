<?php

use yii\db\Migration;

class m181109_143949_create_table_produtocampanha extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%produtocampanha}}', [
            'produtos_idprodutos' => $this->integer()->notNull(),
            'campanha_idCampanha' => $this->integer()->notNull(),
            'campanhaPercentagem' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%produtocampanha}}', ['produtos_idprodutos', 'campanha_idCampanha']);
        $this->createIndex('fk_produtos_has_campanha_campanha1_idx', '{{%produtocampanha}}', 'campanha_idCampanha');
        $this->createIndex('fk_produtos_has_campanha_produtos1_idx', '{{%produtocampanha}}', 'produtos_idprodutos');
        $this->addForeignKey('fk_produtos_has_campanha_campanha1', '{{%produtocampanha}}', 'campanha_idCampanha', '{{%campanha}}', 'idCampanha', 'NO ACTION', 'NO ACTION');
        $this->addForeignKey('fk_produtos_has_campanha_produtos1', '{{%produtocampanha}}', 'produtos_idprodutos', '{{%produto}}', 'idprodutos', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%produtocampanha}}');
    }
}
