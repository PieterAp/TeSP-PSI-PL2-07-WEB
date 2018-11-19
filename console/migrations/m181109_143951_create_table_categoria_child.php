<?php

use yii\db\Migration;

class m181109_143951_create_table_categoria_child extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%categoria_child}}', [
            'idchild' => $this->primaryKey(),
            'childNome' => $this->string()->notNull(),
            'childDescricao' => $this->string(),
            'categoria_idcategorias' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_categoria_child_categoria1_idx', '{{%categoria_child}}', 'categoria_idcategorias');
        $this->addForeignKey('fk_categoria_child_categoria1', '{{%categoria_child}}', 'categoria_idcategorias', '{{%categoria}}', 'idcategorias', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%categoria_child}}');
    }
}
