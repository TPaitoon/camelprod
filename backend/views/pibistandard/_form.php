<?php

use common\models\PIBIStandard;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIStandard */
/* @var $form yii\widgets\ActiveForm */

$num = 0;
if (count(PIBIStandard::find()->all()) > 0) {
    $num = PIBIStandard::find()->max("refid") + 1;
} else {
    $num = 1;
}
?>

<div class="pibistandard-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['id' => 'aaaaa'])->label('มาตรฐาน') ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'refid')->textInput(['readonly' => true,'id' => 'refid', 'value' => $num, 'style' => 'text-align: right'])->label('รหัสอ้างอิง') ?>
        </div>
    </div>
    <div class="form-group">
        <!--?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?-->
        <?= Html::a('<i class="fa fa-plus"></i>','javascript:void(0)', ['class' => 'btn btn-success adddata', 'style' => 'width: 75px']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
