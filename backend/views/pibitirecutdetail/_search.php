<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PibitirecutdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pibitirecutdetail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empno') ?>

    <?= $form->field($model, 'empname') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'stdid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
