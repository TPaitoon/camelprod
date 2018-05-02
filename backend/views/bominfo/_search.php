<?php

use backend\models\BominfoSearch;
use common\models\EmpInfo;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\BominfoSearch */
/* @var $form yii\widgets\ActiveForm */

$JS = <<<JS
    $('#SearchSubmit').click(function(e) {
      e.preventDefault();
      if($('#Sdate').val().split('/').reverse().join('-') > $('#Edate').val().split('/').reverse().join('-')) {
          alert('วันที่เริ่มห้ามน้อยกว่าวันที่สิ้นสุด');
      }else{
          $('#SearchForm').submit();
      }
    })
JS;
$this->registerJs($JS, static::POS_END);

$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['like', 'Sec', 'นึ่ง'])->all();
?>

<div class="bominfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'SearchForm',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="row">
        <div class="col-lg-4" id="empids">
            <?= $form->field($model, 'empid')->widget(Select2::className(), [
                'data' => ArrayHelper::map($empmodel, 'PRS_NO', function ($data) {
                    return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                }),
                'options' => ['placeholder' => 'เลือกรหัสพนักงาน'],
                'pluginOptions' => ['allowClear' => true],
            ])->label('รหัสพนักงานที่ต้องการค้นหา') ?>
        </div>
        <div class="col-lg-2" id="starts">
            <?php $model->startdate == '' ? $model->startdate = date('d/m/Y') : $model->startdate = date('d/m/Y', strtotime(BominfoSearch::ConvertDate($model->startdate))) ?>
            <?= $form->field($model, 'startdate')->widget(DatePicker::className(), [
                'name' => 'startdate',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'layout' => '{picker}{input}',
                'options' => ['id' => 'Sdate'],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ])->label('วันที่เริ่มค้นหา') ?>
        </div>
        <div class="col-lg-2" id="ends">
            <?php $model->enddate == '' ? $model->enddate = date('d/m/Y') : $model->enddate = date('d/m/Y', strtotime(BominfoSearch::ConvertDate($model->enddate))) ?>
            <?= $form->field($model, 'enddate')->widget(DatePicker::className(), [
                'name' => 'enddate',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'layout' => '{picker}{input}',
                'options' => ['id' => 'Edate'],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ])->label('วันที่สิ้นสุดค้นหา') ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'empName') ?>

    <?php // echo $form->field($model, 'typeID') ?>

    <?php // echo $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'stoveid') ?>

    <?php // echo $form->field($model, 'standard') ?>

    <?php // echo $form->field($model, 'hour') ?>

    <?php // echo $form->field($model, 'checkconfirm') ?>

    <?php // echo $form->field($model, 'deduct') ?>

    <?php // echo $form->field($model, 'totaltire') ?>

    <div class="form-group">
        <span id="search"><?= Html::submitButton('ค้นหา', ['id' => 'SearchSubmit', 'class' => 'btn btn-primary']) ?></span>
        <span id="create"><?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?></span>
        <span id="check"><?= Html::button('ยืนยันข้อมูล', ['id' => 'binfo', 'class' => 'btn btn-info pull-right']) ?></span>
    </div>

    <?php ActiveForm::end(); ?>

</div>
