<?php

use yii\db\Migration;

/**
 * Class m180607_084308_insert_close_data_in_word_table
 */
class m180607_084308_insert_close_data_in_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = (new \yii\db\Query())->select('id')->from('string')->orderBy('id DESC')->limit(4)->all();
        
        $array = [
                ['Не', 'далеко', 'пел', 'соловей', 'и', 'летали', 'бабочки.'], 
                ['В', 'окнах', 'зданий', 'переливалось', 'солнце.'], 
                ['Птицы', 'летали', 'высоко', 'в', 'небе.'],
                ['Был', 'тёплый', 'летний', 'день.']
            ];
        $i = 0;
        foreach ($data as $item){
            
            foreach ($array[$i] as $element){
                $this->insert('word', [
                    'syllable' => $element,
                    'string_id' => $item['id']
                ]);
            }
 
        $i++;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $data = (new \yii\db\Query())->select('id')->from('string')->orderBy('id DESC')->limit(4)->all();
        
        foreach ($data as $item){
            $this->delete('word', ['string_id' => $item['id']]);
        }
    }

}
