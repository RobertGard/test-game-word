<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180607_111227_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'victories' => $this->integer()->defaultValue(0),
            'defeat' => $this->integer()->defaultValue(0),
            'role' => $this->string(255)->notNull()->defaultValue('user'),
        ]);
        
        $this->insert('user', [
            'username' => 'admin',
            'password' => \Yii::$app->security->generatePasswordHash('1111'),
            'role' => 'admin',
        ]);
        
        $this->insert('user', [
            'username' => 'user',
            'password' => \Yii::$app->security->generatePasswordHash('2222'),
            'role' => 'user',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['username' => 'user']);
                
        $this->delete('user', ['username' => 'admin']);
        
        $this->dropTable('user');
    }
}
