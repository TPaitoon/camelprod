<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicycleempinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าเข้างานประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;

$JS = <<<JS
    function chkdelete(e) {
        if (confirm('ต้องการลบข้อมูล ?')) {
            if ($(".role").val() !== '1') {
                var status = e.closest('tr').attr('id');
                // alert(status);
                if (status !== '0') {
                    alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
                } else {
                    var link = e.parent().attr('data-url');
                    // alert(link);
                    $.ajax({
                        type: 'post',
                        url: link,
                        async: false,
                        cache: false,
                        success: function() {
                            alert('ลบเรียบร้อยแล้ว');
                            location.reload();
                        }
                    })
                }
            } else {
                var link = e.parent().attr('data-url');
                // alert(link);
                $.ajax({
                    type: 'post',
                    url: link,
                    async: false,
                    cache: false,
                    success: function() {
                        alert('ลบเรียบร้อยแล้ว');
                        location.reload();
                    }
                })
            }
        } 
    }
    
    $("#binfo").on('click',function(e) {
        var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            if ($(".role").val() !== '1') {
                alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
            } else {
                $.ajax({
                    type: 'post',
                    url: '?r=bicycleempinfo/setapproved',
                    data: {dataar:dataar},
                    dataType: 'json',
                    success: function(data) {
                        if (data === 0) {
                            alert("บันทึกถูกยกเลิก");
                        } else if (data === 1) {
                            alert("บันทึกเรียบร้อยแล้ว");
                            location.reload();
                        }
                    }
                });
            }
        }
    });
JS;
$this->registerJs($JS, static::POS_END);
\yii\helpers\Url::remember(Yii::$app->request->getUrl());
if ($Role == 'IT' || $Role == 'PS') {
    $sys = 1;
} else {
    $sys = 0;
}
?>
    <input hidden class="role">
    <div class="bicycle-emp-info-index">
        <div class="panel">
            <div class="panel panel-body">
                <?php echo $this->render('_search', ['model' => $searchModel, 'Role' => $sys]); ?>
                <hr>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'pager' => [
                        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                    ],
                    'rowOptions' => function ($model) {
                        return ['id' => ArrayHelper::getValue($model, 'confirms')];
                    },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'contentOptions' => function ($model) {
                                if (ArrayHelper::getValue($model, 'confirms') !== 0) {
                                    return ['class' => 'text-center', 'style' => 'visibility: hidden'];
                                } else {
                                    return ['class' => 'text-center'];
                                }
                            },
                            'checkboxOptions' => function ($model) {
                                $data = ArrayHelper::getValue($model, 'empid') . ',' . ArrayHelper::getValue($model, 'date');
                                return ['value' => $data];
                            }
                        ],
//                        'id',
                        'empid:text:รหัสพนักงาน',
                        'empName:text:ชื่อ - นามสกุล',
                        'rank:text:ตำแหน่ง',
                        'Extra:integer:เงินพิเศษ',
                        'date:date:วันที่',
                        //'confirms:raw:สถานะ',
                        [
                            'attribute' => 'confirms',
                            'format' => 'raw',
                            'label' => 'สถานะ',
                            'value' => function ($model) {
                                return ArrayHelper::getValue($model, 'confirms') == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                            }
                        ],
                        ['class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                            ],
                            'template' => '{update} {delete}',
                            'contentOptions' => [
                                'class' => 'text-center',
                            ],
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    if (ArrayHelper::getValue($model, 'confirms') == 0) {
                                        return Html::a('<span class="btn btn-default btn-xs glyphicon glyphicon-pencil"></span>', 'javascript:void(0)', [
                                            'id' => 'updatemodal',
                                            'data-url' => $url
                                        ]);
                                    } elseif (ArrayHelper::getValue($model, 'role') == 1) {
                                        return Html::a('<span class="btn btn-default btn-xs glyphicon glyphicon-pencil"></span>', 'javascript:void(0)', [
                                            'id' => 'updatemodal',
                                            'data-url' => $url
                                        ]);
                                    } else {
                                        return '';
                                    }
                                },
                                'delete' => function ($url) {
                                    return Html::a('<span class="btn btn-default btn-xs glyphicon glyphicon-trash" onclick="return chkdelete($(this))"></span>', 'javascript:void(0)', ['data-url' => $url]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $id = ArrayHelper::getValue($model, 'id');
                                $url = 'index.php?r=bicycleempinfo/' . $action . '&id=' . $id;
                                return $url;
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
    "header" => "<h4>รายละเอียด</h4>",
    'size' => "modal-lg"
]);
echo '<div class="modalContent"></div>';
echo '<div class="modal-footer" style="text-align: center">
            <button type="button" class="btn btn-success approved" style="width: 300px">
                ยืนยันข้อมูล
            </button>
     </div>';
Modal::end();

Modal::begin([
    "id" => "modal-create",
    "header" => "<h4>เพิ่มข้อมูล</h4>",
    "size" => "modal-lg"
]);
echo '<div class="modalContent"></div>';
Modal::end();

Modal::begin([
    "id" => "modal-update",
    "header" => "<h4>แก้ไขข้อมูล</h4>",
    "size" => "modal-lg"
]);
echo '<div class="modalContent"></div>';
Modal::end();

$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$res = Yii::$app->session->getFlash('res');
$js = <<<JS
$(".role").val($sys);
var txt = "$res";
if (txt !== "") { alert(txt); }

$(document).on("click","#createmodal",function(e) {
    e.preventDefault();
    var modalc = $("#modal-create");
    if (modalc.hasClass("in")) {
        modalc.find(".modalContent").load($(this).attr("href"));
    } else {
        modalc.modal("show").find(".modalContent").load($(this).attr("href"));
    }
});

$(document).on("click","#updatemodal",function(e) {
    e.preventDefault();
    var modalu = $("#modal-update");
    if (modalu.hasClass("in")) {
        modalu.find(".modalContent").load($(this).attr("data-url"));
    } else {
        modalu.modal("show").find(".modalContent").load($(this).attr("data-url"));
    }
});
JS;

$this->registerJs($js, static::POS_END);
?>