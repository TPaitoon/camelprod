<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCEmplist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pibimcemplist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shift')->textInput() ?>

    <?= $form->field($model, 'group')->textInput() ?>

    <?= $form->field($model, 'empid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
