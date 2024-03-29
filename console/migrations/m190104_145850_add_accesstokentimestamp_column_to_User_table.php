<?php

use yii\db\Migration;

/**
 * Handles adding accesstokentimestamp to table `User`.
 */
class m190104_145850_add_accesstokentimestamp_column_to_User_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('User', 'access_token_timestamp', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('User', 'access_token_timestamp');
    }
}
