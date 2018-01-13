<?php

use backend\models\Pibicalculator;
use common\models\EmpInfo;
use common\models\ShiftList;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PibicalculatorSearch */
/* @var $form yii\widgets\ActiveForm */

//$JS = <<<JS
//    var x = document.getElementById('search');
//    var y = document.getElementById('create');
//    var z = document.getElementById('check');
//    var a = document.getElementById('shift');
//    // var emp = document.getElementById('empids');
//    var st = document.getElementById('starts');
//    var ed = document.getElementById('ends');
//    if ($Role === 1) {
//        x.style.display = 'display';
//        y.style.display = 'display';
//        z.style.display = 'display';
//        // emp.style.display = '';
//        st.style.display = 'display';
//        a.style.display = 'display';
//        ed.style.display = 'display';
//    } else {
//        x.style.display = 'none';
//        //y.style.display = '';
//        z.style.display = 'none';
//        a.style.display = 'none';   
//        // emp.style.display = 'none';
//        st.style.display = 'none';
//        ed.style.display = 'none';
//    }
//JS;
//$this->registerJs($JS, static::POS_END);

$emplist = EmpInfo::find()->where(['Dept' => 'ฝ่ายผลิต'])->andFilterWhere(['like', 'Sec', 'ประกอบยางใน'])->all();
?>

<div class="pibicalculator-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-2" id="shift">
            <?= $form->field($model, 'shift')->widget(Select2::className(), [
                'data' => ArrayHelper::map(ShiftList::find()->all(), 'id', 'shiftname'),
                'options' => ['placeholder' => 'เลือกกะ'],
                'pluginOptions' => ['allowClear' => true]
            ])->label('เลือกกะ') ?>
        </div>
        <div class="col-lg-2" id="starts">
            <?php $model->startdate == '' ? $model->startdate = date('Y-m-d') : $model->startdate ?>
            <?= $form->field($model, 'startdate')->widget(DatePicker::className(), [
                'name' => 'startdate',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => true,
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label('วันที่เริ่มค้นหา') ?>
        </div>
        <div class="col-lg-2" id="ends">
            <?php $model->enddate == '' ? $model->enddate = date('Y-m-d') : $model->enddate ?>
            <?= $form->field($model, 'enddate')->widget(DatePicker::className(), [
                'name' => 'enddate',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'readonly' => true,
                'layout' => '{picker}{input}',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label('วันที่สิ้นสุดค้นหา') ?>
        </div>
    </div>

    <div class="form-group">
        <span id="search"><?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?></span>
        <span id="create"><?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success']) ?></span>
        <span id="check"><?= Html::button('ยืนยันข้อมูล', ['id' => 'binfo', 'class' => 'btn btn-info pull-right']) ?></span>
    </div>

    <?php ActiveForm::end(); ?>
</div>
