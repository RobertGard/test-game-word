<?php

use yii\db\Migration;

/**
 * Class m180607_083238_insert_close_data
 */
class m180607_083238_insert_close_data_in_string_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('string', ['id', 'line'], [
            ['','Был тёплый летний день.'], 
            ['','Птицы летали высоко в небе.'],
            ['','В окнах зданий переливалось солнце.'],
            ['','Не далеко пел соловей и летали бабочки.'], 
            ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('string', ['line' => 'Был тёплый летний день.']);
        $this->delete('string', ['line' => 'Птицы летали высоко в небе.']);
        $this->delete('string', ['line' => 'В окнах зданий переливалось солнце.']);
        $this->delete('string', ['line' => 'Не далеко пел соловей и летали бабочки.']);
    }

}
