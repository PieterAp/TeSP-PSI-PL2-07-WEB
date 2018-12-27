<?php

use yii\db\Migration;

/**
 * Handles adding estado to table `produto`.
 */
class m181209_003734_add_produtoEstado_column_to_produto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('produto', 'produtoEstado', $this->tinyInteger()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('produto', 'produtoEstado');
    }
}
