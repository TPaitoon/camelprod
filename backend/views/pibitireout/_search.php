<?php

use common\models\EmpInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PibitireoutSearch */
/* @var $form yii\widgets\ActiveForm */

$JS = <<<JS
    $('.SearchSubmit').click(function(e) {
      e.preventDefault();
      if($('#Startdate').val().split('/').reverse().join('-') > $('#Enddate').val().split('/').reverse().join('-')) {
          alert('วันที่เริ่มห้ามน้อยกว่าวันที่สิ้นสุด');
      }else{
          $('#SearchForm').submit();
      }
    })
JS;
$this->registerJs($JS, static::POS_END);

$emplist = EmpInfo::findAll(['Dept' => 'ฝ่ายผลิต', 'Sec' => 'ประกอบยางใน']);
//print count($emplist);
?>

<div class="pibitire-out-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'SearchForm'
    ]); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'empid')->widget(Select2::className(), [
                'data' => ArrayHelper::map($emplist, 'PRS_NO', function ($o) {
                    return $o->PRS_NO . ' ' . $o->EMP_NAME . ' ' . $o->EMP_SURNME;
                }),
                'options' => [
                    'placeholder' => 'เลือกรหัสพนักงาน',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label('รหัสพนักงานที่ต้องการค้นหา') ?>
        </div>
        <div class="col-lg-2">
            <?php $model->startdate == '' ? $model->startdate = date('d/m/Y') : $model->startdate ?>
            <?= $form->field($model, 'startdate')->widget(DatePicker::className(), [
                'name' => 'Startdatepicker',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'layout' => '{picker}{input}',
                'options' => [
                    'id' => 'Startdate'
                ],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy',
                ],
            ])->label('วันที่เริ่มค้นหา') ?>
        </div>
        <div class="col-lg-2">
            <?php $model->enddate == '' ? $model->enddate = date('d/m/Y') : $model->enddate ?>
            <?= $form->field($model, 'enddate')->widget(DatePicker::className(), [
                'name' => 'Enddatepicker',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'layout' => '{picker}{input}',
                'options' => [
                    'id' => 'Enddate'
                ],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy',
                ],
            ])->label('วันที่สิ้นสุดค้นหา') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary SearchSubmit']) ?>
        <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success createmodal']) ?>
        <?= Html::button('ยืนยันข้อมูล', ['class' => 'btn btn-info pull-right indexapproved']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
