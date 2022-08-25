<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HappyTicketForm */
/* @var $form ActiveForm */
/* @var $count integer */
?>
<div class="site-happyTicket">

    <?php
    $form = ActiveForm::begin([
        'id' => 'happy-ticket-form',
        'options' => [
            'class' => 'row g-3'
        ]
    ]); ?>
    <div class="col-auto">
        <?= $form->field($model, 'from')->textInput(['autofocus' => true]) ?>
    </div>
    <div class="col-auto">
        <?= $form->field($model, 'to')->textInput(['autofocus' => true]) ?>
    </div>
    <div class="col-auto mt-5">
        <div class="form-group">
            <?= Html::submitButton('Run', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php
    ActiveForm::end(); ?>

    <?php
    if ($count > 0): ?>
        <h3>Number of tickets: <?= $count ?></h3>
    <?php
    endif; ?>
</div>
<!-- site-happyTicket -->
