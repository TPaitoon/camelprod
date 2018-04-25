<?php

use backend\controllers\BicycleinfoController;
use common\models\EmpInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BicycleinfoSearch */
/* @var $form yii\widgets\ActiveForm */

$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต', 'Sec' => 'ประกอบยางนอก'])->all();

$js = <<<JS
    $('#BSearch').click(function(e) {
      e.preventDefault();
      if($('#Sdate').val() > $('#Edate').val()) {
          alert('วันที่เริ่มค้นหาห้ามน้อยกว่าวันที่สิ้นสุด');
      }else{
          $('#SearchForm').submit();
      }
    });   
JS;
$this->registerJs($js, static::POS_END);

?>

<div class="bicycle-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'SearchForm',
    ]); ?>

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
            <?php $model->startdate == '' ? $model->startdate = date('d/m/Y') : $model->startdate = date('d/m/Y', strtotime(BicycleinfoController::ConvertDate($model->startdate))) ?>
            <?= $form->field($model, 'startdate')->widget(DatePicker::className(), [
                'name' => 'startdate',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => true,
                'options' => ['id' => 'Sdate'],
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ])->label('วันที่เริ่มค้นหา') ?>
        </div>
        <div class="col-lg-2" id="ends">
            <?php $model->enddate == '' ? $model->enddate = date('d/m/Y') : $model->enddate = date('d/m/Y', strtotime(BicycleinfoController::ConvertDate($model->enddate))) ?>
            <?= $form->field($model, 'enddate')->widget(DatePicker::className(), [
                'name' => 'enddate',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => true,
                'options' => ['id' => 'Edate'],
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ])->label('วันที่สิ้นสุดค้นหา') ?>
        </div>
    </div>

    <div class="form-group">
        <span id="search"><?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'id' => 'BSearch', 'onclick' => '']) ?></span>
        <span id="create"><?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?></span>
        <span id="check"><?= Html::button('ยืนยันข้อมูล', ['id' => 'binfo', 'class' => 'btn btn-info pull-right']) ?></span>
    </div>

    <?php ActiveForm::end(); ?>

</div>
