<?php

use common\models\EmpInfo;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTDETAIL */
/* @var $form yii\widgets\ActiveForm */

$emplist = EmpInfo::findAll(['Dept' => 'ฝ่ายผลิต', 'Sec' => 'ประกอบยางใน']);
?>

<div class="pibitirecutdetail-form">
    <?php $form = ActiveForm::begin(['id' => 'tirecutform']); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'empno')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                    return $data->PRS_NO . " : " . $data->EMP_NAME . " " . $data->EMP_SURNME;
                }),
                'options' => [
                    'placeholder' => 'เลือกพนักงาน',
                    'id' => '0empno'
                ]
            ])->label('รหัสพนักงาน') ?>
        </div>
        <div class="col-md-3">
            <?php $model->isNewRecord ? $model->date = date('d/m/Y') : $model->date ?>
            <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::className(), [
                'options' => [
                    'id' => '0date'
                ],
                'type' => 3,
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'format' => 'dd/mm/YYYY',
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ])->label('วันที่ทำงาน') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'stdid')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PIBITIRECUTSTANDARD::find()->all(), 'id', 'name'))->label('ตำแหน่ง') ?>
        </div>
    </div>
    <div class="form-group text-center">
        <?php if (!$model->isNewRecord) { ?>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php }else { ?>
        <button type="button" class="btn btn-success btn-lg fa fa-plus" style="width: 20%"></button>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
