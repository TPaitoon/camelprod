<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StandardTireBicycleInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="standard-tire-bicycle-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'standardname')->textInput() ?>

    <?= $form->field($model, 'idexbicycle')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
