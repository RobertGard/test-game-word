<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="container" >
    <?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'method' => 'post',
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model,'text')->textarea(['autofocus' => true]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= Html::submitButton('Генерировать задания', ['class' => 'btn btn-primary', 'name' => 'create-task-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<br>
<?php if(Yii::$app->session->hasFlash('fail')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('fail')?>
    </div>
<?php endif; ?>