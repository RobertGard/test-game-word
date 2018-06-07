<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
/**
 * Description of StringForm
 *
 * @author robert
 */
class StringForm extends Model{
    
    public $text;
    
    public function rules() {
        return [
            [['text'], 'required'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'text' => 'Введите текст'
        ];
    }
    
    /*/
     * Разделение текста на предложения 
     * и создание дерева 
     */
    public function separation($text){
        
        $items =  preg_split("/(?<=[.?!])\s+/", $text);
        
        $tree = [];
        
        foreach ($items as $id => $item){
            if(count(preg_split("/([\s+])/", $item)) > 3){
                $tree[$id]['text'] = $item;
                $tree[$id]['words'] = preg_split("/([\s+])/", $item);
            }
        }
        
        return $tree;
    }
    
    /**
     * Сохранение текста и слов
     */
    public function save(){
        //Получаем дерево для сохранения
        $tree = $this->separation($this->text);
        
        foreach ($tree as $item){
            $string = new StringModel();
            $string->line = $item['text'];
            $string->save();
            foreach ($item['words'] as $syllable){
                $word = new WordModel();
                $word->syllable = $syllable;
                $word->string_id = $string->id;
                $word->save(false);
            }
        }
        
        return TRUE;
    }
}
