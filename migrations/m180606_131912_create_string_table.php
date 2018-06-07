<?php

use yii\db\Migration;

/**
 * Handles the creation of table `line`.
 */
class m180606_131912_create_string_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('string', [
            'id' => $this->primaryKey(),
            'line' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('string');
    }
}
