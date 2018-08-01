<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibistandardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'มาตรฐานประกอบยางในจกย.';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibistandard-index">
    <div class="box box-primary box-solid">
        <div class="box-header">
            <?= Html::a("เพิ่มมาตรฐาน", ["create"], ["class" => "btn btn-success Cstdmodal"]) ?>
            <?= Html::a("เพิ่มรายละเอียด", ["dcreate"], ["class" => "btn btn-success Cstddetailmodal"]) ?>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'name:raw:มาตรฐาน',
                    'hour:raw:ชั่วโมง',
                    'amount:raw:เป้าหมาย',
                    'rate:raw:ค่าพิเศษ'
                    //'refid',

                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php
//Modal::begin([
//    "id" => "Cmodal",
//    "size" => "modal-lg",
//    "header" => "<h4>เพิ่มมาตรฐาน</h4>"
//]);
//echo '<div class="modalContent"></div>';
//Modal::end();

$Js = <<<JS
// $(document).on("click",".Cstdmodal",function(e) {
//     e.preventDefault();
//     var Cmodal = $("#Cmodal");
//     Cmodal.modal({ backdrop: 'static', keyboard: true, show: true}).find(".modalContent").load($(this).attr("href"));
// })
// $("#Cmodal").on("hidden.bs.modal",function() {
//     location.reload();  
// });
JS;
$this->registerJs($Js,static::POS_END);
?>