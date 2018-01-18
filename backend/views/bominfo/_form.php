<?php

use backend\models\ExtraInfo;
use common\models\CheckStatusInfo;
use common\models\EmpInfo;
use common\models\HourInfo;
use common\models\StoveInfo;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BOMInfo */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/calculatebom.js?Ver=0001', ['depends' => JqueryAsset::className()]);

$empmodel = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['like', 'Sec', 'นึ่ง'])->all();
$hourarray = HourInfo::find()->orderBy(['values' => SORT_ASC])->all();
$hourlist = [];
foreach ($hourarray as $item) {
    if ($item->values == '9') {
        continue;
    }
    if ($item->values == '11') {
        continue;
    }
    array_push($hourlist, [
        'hour' => $item->hour,
    ]);
}

//return print_r($hourlist);
//$debug = new \backend\models\CheckDebug();
//$debug->printr($data);return;
?>

<div class="bominfo-form">
    <div class="panel">
        <div class="panel panel-heading">
            <div class="row">
                <div class="col-md-4">
                    <table id="arraytb11" class="table tab-content" border="solid">
                        <h5 class="text-center">
                            <label><?php echo ArrayHelper::getValue($data, '0.name') ?></label>
                        </h5>
                        <thead>
                        <th class="text-center">ค่าต่ำสุด</th>
                        <th class="text-center">ค่าสูงสุด</th>
                        <th class="text-center">อัตรา</th>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '0.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '0.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '0.rate') ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '1.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '1.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '1.rate') ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '2.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '2.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '2.rate') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table id="arraytb12" class="table tab-content" border="solid">
                        <h5 class="text-center">
                            <label><?php echo ArrayHelper::getValue($data, '3.name') ?></label>
                        </h5>
                        <thead>
                        <th class="text-center">ค่าต่ำสุด</th>
                        <th class="text-center">ค่าสูงสุด</th>
                        <th class="text-center">อัตรา</th>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '3.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '3.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '3.rate') ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '4.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '4.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '4.rate') ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '5.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '5.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '5.rate') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table id="arraytb12" class="table tab-content" border="solid">
                        <h5 class="text-center">
                            <label><?php echo ArrayHelper::getValue($data, '6.name') ?></label>
                        </h5>
                        <thead>
                        <th class="text-center">ค่าต่ำสุด</th>
                        <th class="text-center">ค่าสูงสุด</th>
                        <th class="text-center">อัตรา</th>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '6.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '6.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '6.rate') ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '7.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '7.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '7.rate') ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ArrayHelper::getValue($data, '8.min') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '8.max') ?></td>
                            <td><?php echo ArrayHelper::getValue($data, '8.rate') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-body">
            <?php $form = ActiveForm::begin(['id' => 'bomform']); ?>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'empid')->widget(Select2::className(), [
                        'data' => ArrayHelper::map($empmodel, 'PRS_NO', 'PRS_NO'),
                        'options' => [
                            'placeholder' => 'เลือกรหัสพนักงาน',
                            'id' => 'cempid',
                            'onchange' => '$.post("index.php?r=bominfo/showempname&id=' . '"+$(this).val(),function(data){
					$("#cempname").val(data);
					 });',
                        ],])->label('รหัสพนักงาน') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'empName')->textInput(['id' => 'cempname', 'readonly' => true])->label('ชื่อ - นามสกุล') ?>
                </div>
                <div class="col-md-3">
                    <?php $model->date == '' ? $model->date = date('Y-m-d') : $model->date ?>
                    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                        'options' => [
                            'id' => 'cdate'
                        ],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'layout' => '{picker}{input}',
                        'readonly' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ]
                    ])->label('วันที่ทำงาน') ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'stoveid')->dropDownList(ArrayHelper::map(StoveInfo::find()->all(), 'id', 'id'), ['id' => 'cstoveid'])->label('เตาที่') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'standard')->dropDownList(ArrayHelper::map(ExtraInfo::find()->all(), 'ExtraName', 'ExtraName'), ['id' => 'cstandard'])->label('มาตรฐาน') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'hour')->dropDownList(ArrayHelper::map($hourlist, 'hour', 'hour'))->label('ชั่วโมง') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'amount')->textInput(['id' => 'camount', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('ยอดนึ่ง') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'losttime')->textInput(['id' => 'closttime', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'])->label('เสียเวลา : นาที') ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'deduct')->textInput([
                        'id' => 'cdeduct',
                        'autocomplete' => 'off',
                        'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
                    ])->label('หักเงิน') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'totaltire')->textInput(['id' => 'ctotaltire', 'readonly' => true])->label('ยอดยาง') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'perpcs')->textInput(['id' => 'cperpcs', 'readonly' => true])->label('ราคา : เส้น') ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'rate')->textInput(['id' => 'crate', 'readonly' => true])->label('ค่าพิเศษ') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'checkconfirm')->hiddenInput(['value' => 0])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="panel panel-footer">
            <div class="row">
                <div class="pull-left">
                    <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'bomsubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?= Html::button('ค่าเริ่มต้น', ['id' => 'creset', 'class' => 'btn btn-danger']) ?>
                </div>
                <div class="pull-right">
                    <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                    <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
