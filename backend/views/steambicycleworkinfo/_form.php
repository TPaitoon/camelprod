<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SteambicycleworkInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="steambicyclework-info-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'section')->textInput()->label('ตำแหน่งงาน') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'amount')->textInput()->label('จำนวณเงิน') ?>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="pull-left">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <div class="pull-right">
            <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
            <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
