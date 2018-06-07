<?php
use yii\bootstrap\Html;
use yii\grid\GridView;
?>
<?php if($result == 0): ?>
    <div class="col-md-10">
        <div class="alert alert-success"><p class="result-text">Вы распознали замысел автора</p></div>
    </div>
    <div class="col-md-2" style="top: 10px;">
        <?= Html::a('Следующее задание <span class = "glyphicon glyphicon-chevron-right"></span>', $nextUrl, ['class' => 'btn btn-primary', ])?>
    </div>
<?php else: ?>
    <div class="col-md-10">
        <div class="alert alert-danger"><p class="result-text">Увы, но автор думал иначе</p></div>
    </div>
    <div class="col-md-2" style="top: 10px;">
        <?= Html::a('Следующее задание <span class = "glyphicon glyphicon-chevron-right"></span>', $nextUrl, ['class' => 'btn btn-primary', ])?>
    </div>
<?php endif; ?>

<div class="container">
<?= GridView::widget([
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
?>
</div>