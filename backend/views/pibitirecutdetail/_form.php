<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTDETAIL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pibitirecutdetail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empno')->textInput() ?>

    <?= $form->field($model, 'empname')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'stdid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
