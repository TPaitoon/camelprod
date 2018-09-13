<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTSTANDARD */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pibitirecutstandard-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['id' => 'namex'])->label('Name') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'rate')->textInput(['id' => 'ratex']) ?>
        </div>
    </div>
    <div class="form-group">
        <!--?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
        <button type="button" class="btn btn-success fa fa-plus btn-lg adddata"></button>
    </div>
    <?php ActiveForm::end(); ?>
</div>