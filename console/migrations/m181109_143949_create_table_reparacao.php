<?php

use yii\db\Migration;

class m181109_143949_create_table_reparacao extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%reparacao}}', [
            'idreparacao' => $this->primaryKey(),
            'reparacaoNome' => $this->string()->notNull(),
            'reparacaoEstado' => $this->string()->notNull()->defaultValue('Processamento'),
            'reparacaoNumero' => $this->integer()->notNull(),
            'reparacaoData' => $this->dateTime()->notNull(),
            'reparacaoDataConcluido' => $this->dateTime()->notNull(),
            'reparacaoDescricao' => $this->string()->notNull(),
            'user_iduser' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('fk_reparacao_user1_idx', '{{%reparacao}}', 'user_iduser');
        $this->addForeignKey('fk_reparacao_user1', '{{%reparacao}}', 'user_iduser', '{{%userdata}}', 'iduser', 'NO ACTION', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%reparacao}}');
    }
}
