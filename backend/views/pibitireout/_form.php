<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITireOut */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pibitire-out-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empid')->textInput() ?>

    <?= $form->field($model, 'empname')->textInput() ?>

    <?= $form->field($model, 'shift')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
