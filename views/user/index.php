<?php
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'columns' => [
        'username',
        [
            'label' => 'Всего побед',
            'value' => function ($model){
                $sum = $model->victories + $model->defeat;

                $procent=$sum/100;  
                
                $result = (!empty($model->victories)) ? round($model->victories/$procent,2) : 0; 
                
                
                return $model->victories." (".$result."%)";
            }
        ],
                
        [
            'label' => 'Всего поражений',
            'value' => function ($model){
                $sum = $model->victories + $model->defeat;

                $procent=$sum/100;  
                
                $result = (!empty($model->defeat)) ? round($model->defeat/$procent,2) : 0; 
                
                return $model->defeat." (".$result."%)";
            }
        ],

        [
            'label' => 'Всего игр',
            'value' => function ($model){
                return ($model->victories + $model->defeat);
            }
        ]
    ],
]);