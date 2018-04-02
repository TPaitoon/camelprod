<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicycleinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $Role $this|mixed|string */

$js = <<<JS
    
    function chkdelete() {
      return confirm('ต้องการลบข้อมูล ?');
    }
    
     $("#binfo").on('click',function(e) {
        e.preventDefault();
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            // alert(ids);
            var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
            // alert(dataar);
            $.ajax({
                type: 'post',
                url: '?r=bicycleinfo/setapproved',
                data: {dataar:dataar},
                dataType: 'json',
                success: function(data) {
                    if (data === 0) {
                        alert("บันทึกถูกยกเลิก");
                    } else if(data === 1) {
                        alert("บันทึกเรียบร้อยแล้ว");
                        location.reload();
                    }
                }
            });
        }
    })
    
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'ค่าพิเศษประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash('res');


if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
    <div class="bicycle-info-index">
        <div class="panel">
            <div class="panel panel-body">
                <?php echo $this->render('_search', ['model' => $searchModel, 'Role' => $sys]); ?>
                <hr>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                    ],
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                            ],
                            'contentOptions' => [
                                'class' => 'text-center',
                            ],
                            'checkboxOptions' => function ($model) {
                                $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date');
                                return ['value' => $data];
                            }
                        ],
                        //'id',
                        'empid:text:รหัสพนักงาน',
                        'empname:text:ชื่อ - นามสกุล',
                        //'typeid',
                        //'qty',
                        'date:date:วันที่',
                        'tirename:text:เบอร์ยาง',
                        // 'checks',
                        // 'minus',
                        //'grouptire:integer:กลุ่มยาง',
//                        'amount:integer:ยอดผลิต',
//                        'losttime:integer:เสียเวลา',
                        'minus:integer:ยอดยาง',
                        'perpcs:text:ราคา : เส้น',
                        'rate:text:ค่าพิเศษ',
                        [
                            'attribute' => 'checks',
                            'format' => 'raw',
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center status'
                            ],
                            'value' => function ($model) {
                                return ArrayHelper::getValue($model, 'checks') == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                            },
                            'label' => 'สถานะ'
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0)', [
                                        'id' => 'viewmodal',
                                        'data-url' => $url,
                                        'value' => ArrayHelper::getValue($model, "checks") . ":" . ArrayHelper::getValue($model, "empid") . "|" . ArrayHelper::getValue($model, 'date'),
                                    ]);
                                },
                                'update' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                },
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="return chkdelete()"></span>', $url, []);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $empid = ArrayHelper::getValue($model, 'empid');
                                $date = ArrayHelper::getValue($model, 'date');
                                if ($action == 'view') {
                                    $url = 'index.php?r=bicycleinfo/view&empid=' . $empid . '&date=' . $date;
                                    return $url;
                                }
                                if ($action == 'update') {
                                    $url = 'index.php?r=bicycleinfo/update&empid=' . $empid . '&date=' . $date;
                                    return $url;
                                }
                                if ($action == 'delete') {
                                    $url = 'index.php?r=bicycleinfo/delete&empid=' . $empid . '&date=' . $date;
                                    return $url;
                                }
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
<?php
Modal::begin([
    "id" => "modal-view",
    "size" => "modal-lg"
]);
echo "<div class='modalContent'></div>";
echo "<div class='modal-footer' style='text-align: center'>
        <button type='button' class='btn btn-success approved' style='width: 300px'>ยืนยันข้อมูล</button>
</div>";
Modal::end();

$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$js2 = <<<JS
var txt = "$res";
if (txt !== "") { alert(txt); }

$(document).on("click","#viewmodal",function() {
    // alert('');
    var x = $(this).attr("value");
    var str = x.split(":");
    var modalv = $("#modal-view");
    
    if (modalv.hasClass("in")) {
        modalv.find(".modalContent").load($(this).attr("data-url"));
        if (str[0] !== "0") {
            modalv.find(".modal-footer").hide();
        } else {
            modalv.find(".modal-footer").show();
            modalv.find(".approved").val(str[1]);
        }
    } else {
        modalv.modal("show").find(".modalContent").load($(this).attr("data-url"));
        if (str[0] !== '0') {
            modalv.find(".modal-footer").hide();
        } else {
            modalv.find(".modal-footer").show();
            modalv.find(".approved").val(str[1]);
        }
    }
});

$(".approved").on("click",function(e) {
    e.preventDefault();
    // alert($(this).val());
    var role = $(".role").val();
    if (role != 1) {
        alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
    } else if (confirm('ยืนยันการทำรายการ ?')) {
        $.ajax({
        type:"post",
        url:"?r=bicycleinfo/setapproved",
        data:{obj:$(this).val()},
        success: function(data) {
            if (data != 1) {
                alert("บันทึกถูกยกเลิก");
                location.reload();
            } else {
                alert("บันทึกเรียบร้อยแล้ว");
                location.reload();
            } 
        }
        });
    } 
});
JS;

$this->registerJs($js2, static::POS_END);
?>