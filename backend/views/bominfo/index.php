<?php

use backend\models\CheckDebug;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BominfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<JS
    function chkdelete(e) {
        if (confirm('ต้องการลบข้อมูล ?')) {
            if ($(".role").val() !== '1') {
                var status = e.closest('tr').attr('id');
                if (status !== 'Created') {
                    alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
                } else {
                    var link = e.parent().attr('data-url');
                    $.ajax({
                        type: 'post',
                        url: link,
                        async: false,
                        cache: false
                    });
                }
            } else {
                var link = e.parent().attr('data-url');
                $.ajax({
                    type: 'post',
                    url: link,
                    async: false,
                    cache: false
                });
            }
        }
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
        // alert($(".role").val());
        var dataar = $('input[type=checkbox]:checked').map(function() {
            return $(this).val();
        }).get();
      
        if (confirm('ต้องการยืนยันข้อมูล ?')){
            if ($(".role").val() !== '1') {
                alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
            } else {
                $.ajax({
                    type: 'post',
                    url: '?r=bominfo/setapproved',
                    data: {dataar:dataar},
                    dataType: 'json',
                    success: function(data) {
                        if (data === 0) {
                            alert("บันทึกถูกยกเลิก");
                        } else if (data === 1)  {
                            alert("บันทึกเรียบร้อยแล้ว");
                            location.reload();
                        }
                    }
                });
            }
        }
    })            
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'ค่าพิเศษเตา BOM';
$this->params['breadcrumbs'][] = $this->title;
$baseurl = Yii::$app->request->baseUrl;
$session = Yii::$app->session;
$res = $session->getFlash('res');
/*$debug = new CheckDebug();
$debug->printr($dataProvider);
return;*/

if ($Role == 'IT' || $Role == 'PS') {
    $sys = 1;
} else {
    $sys = 0;
}

//echo Yii::$app->formatter->asDate(str_replace('/','-','20/10/2017'),'yyyy-MM-dd');
?>
    <input hidden class="role" value="<?php echo $sys ?>">
    <div class="bominfo-index">
        <div class="panel">
            <div class="panel panel-body">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
                    'options' => [
                        'id' => 'grid',
                    ],
                    'rowOptions' => function ($model) {
                        return ['id' => ArrayHelper::getValue($model, 'check')];
                    },
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
                                $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date') . "," . ArrayHelper::getValue($model, 'stoveid');
                                return ['value' => $data];
                            },
                        ],
                        'empid:text:รหัสพนักงาน',
                        'empname:text:ชื่อ - นามสกุล',
                        'date:date:วันที่',
                        'hour:text:ชั่วโมง',
                        'stoveid:text:เตาที่',
                        'standard:text:มาตรฐาน',
//                    'amount:integer:ยอดนึ่ง',
//                    'losttime:integer:เสียเวลา : นาที',
                        'totaltire:integer:ยอดยาง',
//                    'priceperpcs:text:ราคา : เส้น',
                        'deduct:integer:หักเงิน',
                        'rate:text:ค่าพิเศษ',
//                    'role:text:sssss',
//                    'check:raw:สถานะ',
                        [
                            'attribute' => 'check',
                            'format' => 'raw',
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center status'
                            ],
                            'value' => function ($model) {
                                if (ArrayHelper::getValue($model, 'check') === 'Created') {
                                    return '<label class="label label-info">' . ArrayHelper::getValue($model, 'check') . '</label>';
                                } else {
                                    return '<label class="label label-success">' . ArrayHelper::getValue($model, 'check') . '</label>';
                                }
                            },
                            'label' => 'สถานะ',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center',
                            ],
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0)', [
                                        'id' => 'viewmodal',
                                        'data-url' => $url,
                                        'value' => ArrayHelper::getValue($model, 'check') . ":" . ArrayHelper::getValue($model, 'empid') . "|" . ArrayHelper::getValue($model, 'date') . '|' . ArrayHelper::getValue($model, 'stoveid')
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    if (ArrayHelper::getValue($model, 'check') == 'Created') {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);

                                    } else {
                                        if (ArrayHelper::getValue($model, 'role') == '1') {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);
                                        } else {
                                            return '';
                                        }
                                    }
                                },
                                'delete' => function ($url) {
                                    return Html::a('<span class="glyphicon glyphicon-trash" onclick="return chkdelete($(this))"></span>', 'javascript:void(0)', [
                                        'data-url' => $url,
                                    ]);
                                }
                            ],
                            'urlCreator' => function ($action, $model) {
                                $empid = ArrayHelper::getValue($model, 'empid');
                                $date = ArrayHelper::getValue($model, 'date');
                                $stoveid = ArrayHelper::getValue($model, 'stoveid');

                                $url = '?r=bominfo/' . $action . '&empid=' . $empid . '&date=' . $date . '&stoveid=' . $stoveid;
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
    "size" => "modal-lg",
]);
echo "<div class='modalContent'></div>";
echo "<div class='modal-footer' style='text-align: center'>
            <button type='button' class='btn btn-success approved' style='width: 300px'>ยืนยันข้อมูล</button>
</div>";
Modal::end();

$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$js = <<<JS
    var txt = "$res";
    if (txt !== "") {
        alert(txt);
    }
    
    $(document).on("click","#viewmodal",function() {
        // alert(1234567890);
        var x = $(this).attr("value");
        var str = x.split(":");
        var modalv = $("#modal-view");
        if (modalv.hasClass("in")) {
            modalv.find(".modalContent").load($(this).attr("data-url"));
            if (str[0] !== '0') {
                modalv.find(".modal-footer").hide();
            } else {
                modalv.find(".modal-footer").show();
                modalv.find(".approved").val(str[1]);
            }
        } else {
            modalv.modal("show").find(".modalContent").load($(this).attr("data-url"));
            if (str[0] !== 'Created') {
                modalv.find(".modal-footer").hide();
            } else {
                modalv.find(".modal-footer").show();
                modalv.find(".approved").val(str[1]);
            }
        }
    });
    
    $("#modal-view").on("hidden.bs.modal",function() {
        // location.reload();
    });

    $(".approved").on("click",function(e) {
        e.preventDefault();
        // var data = $(this).val();
        // var aftersplit = data.split("|");
        // alert(aftersplit[0] + " / " + aftersplit[1] + " / " + aftersplit[2]);
        var role = $(".role").val();
        // alert(role);
        if (role == 0) {
            alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
        } else if (role == 1) {
            $.ajax({
            type: "post",
            url: "?r=bominfo/setapproved",
            data: {obj:$(this).val()},
            success: function(data) {
                if (data == 0) {
                    alert("บันทึกถูกยกเลิก");
                    location = "?r=bominfo";
                } else if (data == 1) {
                    alert("บันทึกเรียบร้อยแล้ว");
                    location = "?r=bominfo";
                    // alert(data);
                }
            }
        });
        }     
    });
JS;
$this->registerJs($js, static::POS_END);
?>