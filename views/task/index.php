<?php

use yii\bootstrap\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Как бы написал автор?</h1>

        <p class="lead">Небольшую клиент-серверная игра.</p>

        <p><?= Html::a('Начать игру', ['/task/view', 'id' => $model->id], ['class' => 'btn btn-lg btn-success'])?></p>
        <p><?= Html::a('Посмотреть статистику', ['/user/index'], ['class' => 'btn btn-lg btn-primary'])?></p>
    </div>
</div>
