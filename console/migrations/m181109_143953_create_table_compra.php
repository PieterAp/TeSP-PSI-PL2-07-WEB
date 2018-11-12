<?php

use yii\db\Migration;

class m181109_143953_create_table_compra extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%compra}}', [
            'idcompras' => $this->primaryKey(),
            'compraData' => $this->dateTime()->notNull(),
            'user_iduser' => $this->integer()->notNull(),
            'compraValor' => $this->float()->notNull(),
            'compraEstado' => $this->tinyInteger()->defaultValue('1'),
        ], $tableOptions);

        $this->createIndex('fk_compras_user_idx', '{{%compra}}', 'user_iduser');
        $this->addForeignKey('fk_compras_user', '{{%compra}}', 'user_iduser', '{{%userdata}}', 'iduser', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%compra}}');
    }
}
