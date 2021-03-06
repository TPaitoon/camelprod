<?php

use common\models\CheckStatusInfo;
use common\models\ShiftList;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitireoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าพิเศษออกยางแทน.';
$this->params['breadcrumbs'][] = $this->title;

$scriptjs = <<<JS
function checkDel(e) {
    if (confirm('ต้องการลบข้อมูล ?')) {
        //alert($(".role").val());
        if ($(".role").val() != 1) {
            var status = e.closest('tr').attr('id');
            // alert(status);
            if (status != 0) {
                alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
            } else {
                var link = e.parent().attr('data-url');
                // alert('');
                $.ajax({
                    type:'post',
                    url:link,
                    async:false,
                    cache:false
                });
            } 
        } else {
            var link = e.parent().attr('data-url');
            // alert(link);
            $.ajax({
                type:'post',
                url:link,
                async:false,
                cache:false
            });
        }
    }   
}

$(".indexapproved").on("click",function(e) {
    e.preventDefault();
    if ($(".role").val() != 1) {
        alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
    }else if (confirm("ยืนยันการทำรายการ ?")) {
        var dataar = $("input[type=checkbox]:checked").map(function() {
            return $(this).val();
        }).get();
        // alert(dataar);
        $.ajax({
            type:"post",
            url:"?r=pibitireout/setapproved",
            data:{dataar:dataar},
            success: function(data) {
                if (data != 1) {
                    alert(data);
                } else {
                    alert("บันทึกเรียบร้อยแล้ว");
                    location.reload();
                } 
            }
        });
    } 
});

$(".indexdelete").on("click",function() {
    // alert('');
    var dataar = $("input[type=checkbox]:checked").map(function() {
            return $(this).val();
        }).get();
    $.ajax({
        type: "post",
        url: "?r=pibitireout/loopdelete",
        data: {dataar:dataar},
        success: function(data) {
            if (data != 1)
                alert("ยกเลิกการทำรายการ");
            else
                alert("ลบข้อมูลเรียบร้อยแล้ว");
            location.reload();
        }
    });
});
JS;
$this->registerJs($scriptjs, static::POS_END);
Url::remember();
?>
<input hidden class="role" value="<?= $role ?>">
<div class="pibitireout-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?= $this->render('_search', ['model' => $searchModel]) ?>
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                ],
                'options' => [
                    'id' => 'grid'
                ],
                'rowOptions' => function ($model) {
                    return ['id' => ArrayHelper::getValue($model, 'status')];
                },
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => [
                            'class' => 'text-center',
                            'style' => 'width:5%'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ]
                    ],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => [
                            'class' => 'text-center',
                            'style' => 'width:5%'
                        ],
                        'contentOptions' => function ($model) {
                            $id = ArrayHelper::getValue($model, 'status');
                            if ($id !== 0) {
                                return ["class" => "text-center", "style" => "visibility: hidden"];
                            } else {
                                return ["class" => "text-center"];
                            }
                        },
                        'checkboxOptions' => function ($model) {
                            return ['value' => ArrayHelper::getValue($model, 'id') . ":"];
                        }
                    ],
//                    'empid:raw:รหัสพนักงาน',
                    [
                        'attribute' => 'empid',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:15%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'label' => 'รหัสพนักงาน'
                    ],
                    [
                        'attribute' => 'empname',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:15%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'label' => 'ชื่อ - นามสกุล'
                    ],
//                    'empname:raw:ชื่อ - นามสกุล',
                    [
                        'attribute' => 'shift',
                        'headerOptions' => [
                            'style' => 'width:15%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'format' => 'raw',
                        'value' => function ($model) {
                            $id = ArrayHelper::getValue($model, 'shift');
                            if ($id === 1) {
                                $dis = "label label-primary";
                            } else {
                                $dis = "label label-warning";
                            }
                            $s = ShiftList::findOne(['id' => $id]);
                            return '<label class="' . $dis . '">' . $s->shiftname . '</label>';
                        },
                        'label' => 'ช่วงทำงาน'
                    ],
//                    'date:date:วันที่',
                    [
                        'attribute' => 'date',
                        'format' => 'date',
                        'headerOptions' => [
                            'style' => 'width:15%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'label' => 'วันที่'
                    ],
//                    'qty:raw:ค่าพิเศษ',
                    [
                        'attribute' => 'qty',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:15%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'label' => 'ค่าพิเศษ'
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'headerOptions' => [
                            'style' => 'width:10%',
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center status'
                        ],
                        'value' => function ($model) {
                            $id = ArrayHelper::getValue($model, 'status');
                            $s = CheckStatusInfo::findOne(['statusid' => $id]);
                            if ($id === 0) {
                                $dis = "label label-info";
                            } else {
                                $dis = "label label-success";
                            }
                            return '<label class="' . $dis . '">' . $s->name . '</label>';
                        },
                        'label' => 'สถานะ'
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center',
                            'style' => 'width:10%'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                $st = ArrayHelper::getValue($model, 'status');
                                $rl = ArrayHelper::getValue($model, 'role');
                                if ($st === 0) {
                                    return Html::a('<span class="btn btn-default btn-xs glyphicon glyphicon-pencil"></span>', 'javascript:void(0)', ['id' => 'updatemodal', 'data-url' => $url]);
                                } elseif ($rl === 1) {
                                    return Html::a('<span class="btn btn-default btn-xs glyphicon glyphicon-pencil"></span>', $url, ['id' => 'updatemodal', 'data-url' => $url]);
                                } else {
                                    return '';
                                }
                            },
                            'delete' => function ($url) {
                                return Html::a('<span class="btn btn-default btn-xs glyphicon glyphicon-trash" onclick="checkDel($(this))"></span>', 'javascript:void(0)', [
                                    'data-url' => $url
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model) {
                            $id = ArrayHelper::getValue($model, 'id');
                            return "?r=pibitireout/" . $action . "&id=" . $id;
                        }
                    ],
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

Modal::begin([
    "id" => "update-modal",
    "size" => "modal-lg",
    "header" => "<h4>แก้ไขข้อมูล</h4>",
]);
echo "<div class='modalContent'></div>";
Modal::end();

$modaljs = <<<JS
// $(document).on("click",".createmodal",function(e) {
//     e.preventDefault();
//     // alert();
//     var cmodal = $("#create-modal");
//    
//     if (cmodal.hasClass("in")) {
//         cmodal.find(".modalContent").load($(this).attr("href"));
//     } else {
//         cmodal.modal("show",{backdrop:"static",keyboard:true}).find(".modalContent").load($(this).attr("href"));       
//     }
// });

$(document).on("click","#updatemodal",function(e) {
    e.preventDefault();
    // alert();
    var umodal = $("#update-modal");
    
    if (umodal.hasClass("in")) {
        umodal.find(".modalContent").load($(this).attr("data-url"));
    } else {
        umodal.modal("show",{backdrop:"static",keyboard:true}).find(".modalContent").load($(this).attr("data-url"));       
    }
});

$("#create-modal").on("hidden.bs.modal",function() {
    location.reload();
});
JS;
$this->registerJs($modaljs, static::POS_END);
?>
