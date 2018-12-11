<?php

use yii\db\Migration;

class m181109_143949_create_table_campanha extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%campanha}}', [
            'idCampanha' => $this->primaryKey(),
            'campanhaNome' => $this->string()->notNull(),
            'campanhaDataInicio' => $this->date()->notNull(),
            'campanhaDescricao' => $this->string()->notNull(),
            'campanhaDataFim' => $this->date()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%campanha}}');
    }
}
