<?php

use common\models\Department;
use common\models\EmpInfo;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Userinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userinfo-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->widget(Select2::className(), [
                'data' => ArrayHelper::map(EmpInfo::find()->all(), function ($data) {
                    return $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                }, function ($data) {
                    return $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                }),
                'options' => [
                    'placeholder' => 'เลือกรายชื่อพนักงาน'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'Dept')->widget(Select2::className(), [
                'data' => ArrayHelper::map(Department::find()->all(), 'deptid', function ($data) {
                    return $data->deptid . ' [' . $data->deptdesc . ']';
                }),
                'options' => [
                    'placeholder' => 'เลือกแผนก'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput(['autocomplete' => 'off']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="pull-left">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <div class="pull-right">
            <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
