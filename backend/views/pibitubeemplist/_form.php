<?php

use common\models\ShiftList;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBITubeEmplist */
/* @var $form yii\widgets\ActiveForm */
$shiftlist = ShiftList::find()->all();

?>
<div class="pibitube-emplist-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-12">
            <div class="col-lg-3">
                <?= $form->field($model, 'shift')->dropDownList(ArrayHelper::map($shiftlist, "id", "shiftname"), ["id" => "shift"])->label("เลือกกะ") ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                    'name' => 'date',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{picker}{input}',
                    'readonly' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ],
                    'options' => [
                        'id' => 'datepicker',
                    ]
                ])->label('วันที่') ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>