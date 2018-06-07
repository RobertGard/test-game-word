<?php

use yii\db\Migration;

/**
 * Handles the creation of table `words`.
 */
class m180606_132713_create_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('word', [
            'id' => $this->primaryKey(),
            'syllable' => $this->string()->notNull(),
            'string_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('word');
    }
}
