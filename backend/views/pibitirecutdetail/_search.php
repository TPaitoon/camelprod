<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PibitirecutdetailSearch */
/* @var $form yii\widgets\ActiveForm */

$emplist = \common\models\EmpInfo::findAll(["Dept" => "ฝ่ายผลิต", "Sec" => "ประกอบยางใน"]);
?>

    <div class="pibitirecutdetail-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'empno')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                        return $data->PRS_NO . " " . $data->EMP_NAME . " " . $data->EMP_SURNME;
                    }),
                    'options' => [
                        "placeholder" => "เลือกพนักงาน",
                        "id" => "empnoselect"
                    ],
                ]) ?>
            </div>
            <div class="col-md-3">
                <?php empty($model->startdate) ? $model->startdate = date('d/m/Y') : $model->startdate ?>
                <?= $form->field($model, 'startdate')->widget(\kartik\date\DatePicker::className(), [
                    'name' => 'startdate',
                    'type' => 3,
                    'layout' => '{picker}{input}',
                    'options' => ['id' => 'startdate'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ])->label('วันที่เริ่มค้นหา') ?>
            </div>
            <div class="col-md-3">
                <?php empty($model->enddate) ? $model->enddate = date('d/m/Y') : $model->enddate ?>
                <?= $form->field($model, 'enddate')->widget(\kartik\date\DatePicker::className(), [
                    'name' => 'enddate',
                    'type' => 3,
                    'layout' => '{picker}{input}',
                    'options' => ['id' => 'enddate'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ])->label('วันที่สิ้นสุดค้นหา') ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary searchbtn']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::button('ยืนยันข้อมูล', ['id' => 'binfo', 'class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$js = <<<JS
$(".searchbtn").click(function(e) {
    e.preventDefault();
    var sd = $("#startdate");
    var ed = $("#enddate");
    if (sd.val().split('/').reverse().join('-') > ed.val().split('/').reverse().join('-')) {
        alert('วันที่เริ่มต้องไม่มากกว่าวันที่สิ้นสุด');
    } else {
        $(this).submit();
    }
})
JS;
$this->registerJs($js, static::POS_END);
?>