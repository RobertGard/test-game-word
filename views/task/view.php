<?php 
use yii\bootstrap\Html;

$this->registerJsFile('@web/js/modular.js',['position' => yii\web\View::POS_END]);

?>

<h3>Предложение: </h3>

<div class="container alert alert-warning" id="box-string">

</div>
<div class="container">
    <div class="row" id="box-words">
        <?php foreach ($result as $item):?>
            <?php if(!empty($item['syllable'])):?>
                <div class="col-md-3 words btn btn-default"><?= $item['syllable']; ?></div>
            <?php endif;?>
        <?php endforeach;?>
    </div>
</div>
<div class="row block-result">
    <div class="col-md-3 col-check-answer" style="top: 10px;">
        <?= Html::submitButton('<span class = "glyphicon glyphicon-zoom-in"></span> Проверить', ['class' => 'btn btn-primary check-answer', 'name' => 'create-task-button', 'data-id' => $id]) ?>
    </div>
</div>
 