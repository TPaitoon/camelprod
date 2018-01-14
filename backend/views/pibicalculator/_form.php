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
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Pibicalculator */
/* @var $form yii\widgets\ActiveForm */

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['Sec' => 'ประกอบยางใน'])->all();
$itemlist = PIBIStandard::find()->all();
$shiftlist = ShiftList::find()->all();
$hourlist = HourInfo::find()->orderBy(['values' => SORT_ASC])->all();

?>
<div class="pibicalculator-form">
    <div class="row">
        <div class="col-lg-12">
            <h5><b>เลือกรายชื่อพนักงาน</b></h5>
        </div>
        <div class="col-lg-3">
            <?= Select2::widget([
                'id' => 'emplistselect',
                'name' => 'empselect',
                'data' => ArrayHelper::map($emplist, 'PRS_NO', function ($data) {
                    return $data->PRS_NO . ' ' . $data->EMP_NAME . ' ' . $data->EMP_SURNME;
                }),
                'options' => ['placeholder' => 'เลือกพนักงาน']
            ]) ?>
        </div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-success addemp"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php $form = ActiveForm::begin() ?>
        <div class="col-lg-4">
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
                        <input type="text" name="empnames[]" class="form-control" readonly>
                    </td>
                    <td style="text-align: center">
                        <button type="button" class="btn btn-danger removeline" onclick=""><i class="fa fa-minus"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-3">
                    <?php echo "จำนวณพนักงาน : " ?>
                </div>
                <div class="col-lg-1">
                    <label class="cline" style="color: #00a157">#</label>
                </div>
                <div class="col-lg-1">
                    คน
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-lg-2">
                    <?= $form->field($model, 'Shiftid')->widget(Select2::className(), [
                        'data' => ArrayHelper::map($shiftlist, 'id', 'shiftname')
                    ])->label('ช่วงเวลาทำงาน') ?>
                </div>
                <div class="col-lg-1">
                    <?= $form->field($model, 'Groupid')->textInput(['maxlength' => 2, 'autocomplete' => 'off', 'id' => 'groupid', 'onkeypress' => 'return chknumber(event);', 'style' => 'text-align: center'])->label('กลุ่ม') ?>
                </div>
                <div class="col-lg-3">
                    <?php $model->Date == '' ? $model->Date = date('Y-m-d') : $model->Date ?>
                    <?= $form->field($model, 'Date')->widget(DatePicker::classname(),[
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
                    ]) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

<?php
$scriptchk = <<<JS
    function chknumber(event) {
        var key = window.event ? event.keyCode : event.which;
        //alert(key);
        if (key === 8 || key === 46 || key === 37 || key === 39 || key === 0) {
            return true;
        } else if ( key < 48 || key > 57 ) {
            return false;
        }
        return true;
    }
JS;
$this->registerJs($scriptchk, static::POS_END);
?>
