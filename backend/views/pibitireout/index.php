<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitireoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าพิเศษออกยางแทน.';
$this->params['breadcrumbs'][] = $this->title;
?>
<input hidden class="role" value="<?php /* $role */ ?>">
<div class="pibitireout-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?= Html::a("เพิ่มข้อมูล", ["create"], ["class" => "btn btn-success bcreate"]) ?>
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'empid',
                    'empname',
                    'shift',
                    'date',
                    'qty',
                    'status',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php
Modal::begin([
    "id" => "create-modal",
    "size" => "modal-lg",
    "header" => "<h4>เพิ่มข้อมูล</h4>",
]);
echo "<div class='modalContent'></div>";
Modal::end();

$modaljs = <<<JS
$(document).on("click",".bcreate",function(e) {
    e.preventDefault();
    // alert();
    var cmodal = $("#create-modal");
    
    if (cmodal.hasClass("in")) {
        cmodal.find(".modalContent").load($(this).attr("href"));
    } else {
        cmodal.modal("show",{backdrop:"static",keyboard:true}).find(".modalContent").load($(this).attr("href"));       
    }
});
JS;
$this->registerJs($modaljs, static::POS_END);
?>
