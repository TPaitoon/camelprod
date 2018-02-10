<?php

use common\models\ShiftList;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PibitubeemplistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pibitube-emplist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'shift')
                ->widget(Select2::className(), [
                    "data" => ArrayHelper::map(ShiftList::find()->all(), "id", "shiftname"),
                    "options" => ["placeholder" => "เลือกกะ"],
                    "pluginOptions" => ["allowClear" => true]
                ])
                ->label('เลือกกะ') ?>
        </div>
        <div class="col-lg-2">
            <?php empty($model->date) ? $model->date = date('Y-m-d') : $model->date ?>
            <?= $form->field($model, 'date')
                ->widget(DatePicker::className(), [
                    'name' => 'datepicker',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'readonly' => true,
                    'layout' => '{picker}{input}',
                    'options' => ['id' => 'datepicker'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
                ->label('วันที่') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'btn btn-success createmodal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
