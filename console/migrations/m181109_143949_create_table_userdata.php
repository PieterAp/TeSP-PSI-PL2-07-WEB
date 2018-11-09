<?php

use yii\db\Migration;

class m181109_143949_create_table_userdata extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%userdata}}', [
            'iduser' => $this->integer()->notNull(),
            'userNomeProprio' => $this->string()->notNull(),
            'userApelido' => $this->string()->notNull(),
            'userNIF' => $this->integer(),
            'userDataNasc' => $this->date(),
            'userEstado' => $this->string()->notNull()->defaultValue('guest'),
            'userMorada' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'userVisibilidade' => $this->tinyInteger()->defaultValue('1'),
        ], $tableOptions);

        $this->addPrimaryKey('PRIMARYKEY', '{{%userdata}}', ['iduser', 'user_id']);
        $this->createIndex('fk_userdata_user1_idx', '{{%userdata}}', 'user_id');
        $this->addForeignKey('fk_userdata_user1', '{{%userdata}}', 'user_id', '{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%userdata}}');
    }
}
