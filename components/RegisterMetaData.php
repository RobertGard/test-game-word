<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use yii\base\Behavior;
/**
 * Description of RegisterMetaData
 *
 * @author robert
 */
class RegisterMetaData extends Behavior{
    
    public function setMeta($title = NULL, $keywords = NULL, $description = NULL){
        $view = \Yii::$app->view;
        
        $view->title = !empty($title) ? $title : "";
        
        $view->registerMetaTag(['name' => 'keywords', 'content' => "{$keywords}"]);
        $view->registerMetaTag(['name' => "description", 'content' => "{$description}"]);
    }
    
}
