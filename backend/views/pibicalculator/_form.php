<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 13/01/2018
 * Time: 10:34 AM
 */

use common\models\EmpInfo;
use common\models\HourInfo;
use common\models\PIBIStandard;
use common\models\ShiftList;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Pibicalculator */
/* @var $form yii\widgets\ActiveForm */

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['Sec' => 'ประกอบยางใน'])->all();
$itemlist = PIBIStandard::find()->all();
$shiftlist = ShiftList::find()->all();
$hourlist = HourInfo::find()->orderBy(['values' => SORT_ASC])->all();

$grouplist = [];
for ($i = 1; $i <= 15; $i++) {
    array_push($grouplist, ['A' => $i]);
}
?>
<div class="pibicalculator-form">
    <div class="row">
        <?php $form = ActiveForm::begin() ?>
        <div class="col-lg-4" id="select-form">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5><b>เลือกรายชื่อพนักงาน</b></h5>
                        </div>
                        <div class="col-lg-10">
                            <?= Select2::widget([
                                'name' => 'empselect',
                                'data' => ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                                    return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                                }),
                                'options' => [
                                    'placeholder' => 'เลือกพนักงาน',
                                    'id' => 'emplistselect'
                                ]
                            ]) ?>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-success addemp"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered listemp">
                        <thead>
                        <tr>
                            <th>รหัสพนักงาน</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th class="text-center">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td width="150">
                                <input type="text" name="empids[]" class="form-control empid" readonly>
                            </td>
                            <td>
                                <input type="text" name="empnames[]" class="form-control empname" readonly>
                            </td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-danger" onclick="removeline($(this))">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel panel-footer">
                    <div class="row">
                        <div class="col-lg-3">
                            <?php echo "จำนวณพนักงาน : " ?>
                        </div>
                        <div class="col-lg-1">
                            <label id="cline" style="color: #00a157">#</label>
                        </div>
                        <div class="col-lg-1">
                            คน
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-1"></div>

        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel panel-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'Shiftid')
                                ->dropDownList(ArrayHelper::map($shiftlist, 'id', 'shiftname'))
                                ->label('เลือกกะ') ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'Groupid')
                                ->dropDownList(ArrayHelper::map($grouplist, 'A', 'A'))
                                ->label('กลุ่ม') ?>
                        </div>
                        <div class="col-lg-3">
                            <?php $model->Date == '' ? $model->Date = date('Y-m-d') : $model->Date ?>
                            <?= $form->field($model, 'Date')
                                ->widget(DatePicker::classname(), [
                                    'options' => ['id' => 'date'],
                                    'name' => 'datepick',
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'layout' => '{picker}{input}',
                                    'readonly' => true,
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'autoclose' => true,
                                        'todayHighlight' => true
                                    ]
                                ])
                                ->label('วันที่') ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'Hour')
                                ->dropDownList(ArrayHelper::map($hourlist, 'values', 'hour'), ['id' => 'hour'])
                                ->label('ชั่วโมงงาน') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'Itemid')
                                ->dropDownList(ArrayHelper::map($itemlist, 'refid', 'name'), ['id' => 'std'])
                                ->label('มาตรฐาน') ?>
                        </div>
                        <div class="col-lg-2">
                            <!-- ยอดผลิต -->
                            <?php $model->amount == '' ? $model->amount = 0 : $model->amount ?>
                            <?= $form->field($model, 'amount')
                                ->textInput(['maxlength' => 5, 'autocomplete' => 'off', 'id' => 'amount', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: right'])
                                ->label('ยอดผลิต') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?php $model->losttire1 == '' ? $model->losttire1 = 0 : $model->losttire1 ?>
                            <?= $form->field($model, 'losttire1')
                                ->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'losttire1', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: right'])
                                ->label('ยางเสีย (ก่อนนึ่ง) : เส้น') ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'dummy1')
                                ->textInput(['readonly' => 'true', 'value' => '0.30', 'style' => 'text-align: right', 'id' => 'dummy1'])
                                ->label('หักเงิน : เส้น') ?>
                        </div>
                        <div class="col-lg-2">
                            <?php $model->listprice1 == '' ? $model->listprice1 = 0 : $model->listprice1 ?>
                            <?= $form->field($model, 'listprice1')
                                ->textInput(['readonly' => 'true', 'style' => 'text-align: right', 'id' => 'listprice1'])
                                ->label('คิดเป็นเงิน : บาท') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?php $model->losttire2 == '' ? $model->losttire2 = 0 : $model->losttire2 ?>
                            <?= $form->field($model, 'losttire2')
                                ->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'losttire2', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: right'])
                                ->label('ยางเสีย (หลังนึ่ง) : เส้น') ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'dummy2')
                                ->textInput(['readonly' => 'true', 'value' => '5.00', 'style' => 'text-align: right', 'id' => 'dummy2'])
                                ->label('หักเงิน : เส้น') ?>
                        </div>
                        <div class="col-lg-2">
                            <?php $model->listprice2 == '' ? $model->listprice2 = 0 : $model->listprice2 ?>
                            <?= $form->field($model, 'listprice2')
                                ->textInput(['readonly' => 'true', 'style' => 'text-align: right', 'id' => 'listprice2'])
                                ->label('คิดเป็นเงิน : บาท') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?php $model->losttube == '' ? $model->losttube = 0 : $model->losttube ?>
                            <?= $form->field($model, 'losttube')
                                ->textInput(['maxlength' => 4, 'autocomplete' => 'off', 'id' => 'losttube', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: right'])
                                ->label('จุ๊บเสีย : ตัว') ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'dummy3')
                                ->textInput(['readonly' => 'true', 'value' => '7.00', 'style' => 'text-align: right', 'id' => 'dummy3'])
                                ->label('หักเงิน : ตัว') ?>
                        </div>
                        <div class="col-lg-2">
                            <?php $model->listprice3 == '' ? $model->listprice3 = 0 : $model->listprice3 ?>
                            <?= $form->field($model, 'listprice3')
                                ->textInput(['readonly' => 'true', 'style' => 'text-align: right', 'id' => 'listprice3'])
                                ->label('คิดเป็นเงิน : บาท') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'xrate')
                                ->textInput(['readonly' => true, 'value' => 0, 'style' => 'text-align: right', 'id' => 'xrate'])
                                ->label('ค่าพิเศษ') ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'deduct')
                                ->textInput(['readonly' => true, 'value' => 0, 'style' => 'text-align: right', 'id' => 'deduct'])
                                ->label('หักเงินทั้งหมด') ?>
                        </div>
                        <div class="col-lg-2">
                            <?php $model->Rate == '' ? $model->Rate = 0 : $model->Rate ?>
                            <?= $form->field($model, 'Rate')
                                ->textInput(['readonly' => true, 'style' => 'text-align: right', 'id' => 'rate'])
                                ->label('ค่าพิเศษ : คน') ?>
                        </div>
                        <div class="col-lg-2">
                            <input hidden class="listid" name="listid[]" value="<?php echo $model->listid ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-left">
                            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['id' => 'pibisubmit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <span hidden><?= Html::button('ตรวจสอบ', ['id' => 'checkinfo', 'class' => 'btn btn-info']) ?></span>
                        </div>
                        <div class="pull-right">
                            <?= Html::a('หน้าหลัก', ['index'], ['class' => 'btn btn-info']) ?>
                            <?= Html::a('ย้อนกลับ', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . '/js/chkkeypressnumber.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibi/newline.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerJsFile($baseurl . '/js/pibi/calculator.js?Ver=0001', ['depends' => JqueryAsset::className()]);
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>
