<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StandardbicycleexSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="standardbicycle-ex-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'average') ?>

    <?= $form->field($model, 'groups') ?>

    <?= $form->field($model, 'amountWork') ?>

    <?= $form->field($model, 'valueMin') ?>

    <?php // echo $form->field($model, 'valueMax') ?>

    <?php // echo $form->field($model, 'Rate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
