<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 23/01/2018
 * Time: 10:49 AM
 */

use common\models\EmpInfo;
use common\models\ShiftList;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])
    ->andFilterWhere(['like', 'Sec', 'ประกอบยางใน'])->all();

$js = <<<JS
    $('#SearchSubmit').click(function(e) {
        e.preventDefault();
        if ($("#startdate").val().split('/').reverse().join('-') > $("#enddate").val().split('/').reverse().join('-')) {
            alert('วันที่เริ่มต้องไม่มากกว่าวันที่สิ้นสุด');
        } else {
            $(this).submit();
        }
    })
JS;
$this->registerJs($js, static::POS_END);
?>

<div class="pibicalculator-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'shift')
                ->widget(Select2::className(), [
                    'data' => ArrayHelper::map(ShiftList::find()->all(), 'id', 'shiftname'),
                    'options' => ['placeholder' => 'เลือกกะ'],
                    'pluginOptions' => ['allowClear' => true]
                ])
                ->label('เลือกกะ')
            ?>
        </div>
        <div class="col-lg-2">
            <?php empty($model->startdate) ? $model->startdate = date('d/m/Y') : $model->startdate; ?>
            <?= $form->field($model, 'startdate')
                ->widget(DatePicker::className(), [
                    'name' => 'startdate',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'readonly' => true,
                    'layout' => '{picker}{input}',
                    'options' => ['id' => 'startdate'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ])
                ->label('วันที่เริ่มค้นหา')
            ?>
        </div>
        <div class="col-lg-2">
            <?php empty($model->enddate) ? $model->enddate = date('d/m/Y') : $model->enddate; ?>
            <?= $form->field($model, 'enddate')
                ->widget(DatePicker::className(), [
                    'name' => 'enddate',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'readonly' => true,
                    'layout' => '{picker}{input}',
                    'options' => ['id' => 'enddate'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ])
                ->label('วันที่สิ้นสุดค้นหา')
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'id' => 'SearchSubmit']) ?>
        <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('ยืนยันข้อมูล', ['id' => 'binfo', 'class' => 'btn btn-info']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
