<?php

use yii\db\Migration;

class m181109_143950_create_table_categoria extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%categoria}}', [
            'idcategorias' => $this->primaryKey(),
            'categoriaNome' => $this->string(25)->notNull(),
            'categoriaDescricao' => $this->string(128),
            'categoriaEstado' => $this->tinyInteger()->defaultValue(0)
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%categoria}}');
    }
}
