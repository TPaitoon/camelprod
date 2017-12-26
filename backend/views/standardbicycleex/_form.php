<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StandardbicycleEx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="standardbicycle-ex-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'average')->textInput() ?>

    <?= $form->field($model, 'groups')->textInput() ?>

    <?= $form->field($model, 'amountWork')->textInput() ?>

    <?= $form->field($model, 'valueMin')->textInput() ?>

    <?= $form->field($model, 'valueMax')->textInput() ?>

    <?= $form->field($model, 'Rate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
