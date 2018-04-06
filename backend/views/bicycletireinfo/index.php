<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicycletireinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$js = <<<JS
    function chkdelete(e) {
      if (confirm('ต้องการลบข้อมูล ?')) {
          if ($(".role").val() !== '1') {
              var status = e.closest('tr').attr('id');
              if (status !== '0') {
                  alert('ไม่สามารถลบข้อมูลได้เนื่องจากไม่มีสิทธิ์');
              } else {
                  var link = e.parent().attr('data-url');
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
              $.ajax({
                  type: 'post',
                  url: link,
                  async: false,
                  cache: false,
                  success: function() {
                      alert('ลบเรียบร้อยแล้ว');
                      location = '?r=bicycletireinfo';
                  }
              })
          }
      }
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
        var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
        if (confirm('ต้องการยืนยันข้อมูล ?')) {
            if ($(".role").val() !== '1') {
                alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
            } else {
                $.ajax({
                    type: 'post',
                    url: '?r=bicycletireinfo/setapproved',
                    data: {dataar:dataar},
                    dataType: 'json',
                    success: function(data) {
                        if (data === 0){
                            alert("บันทึกถูกยกเลิก");
                        } else if (data === 1){
                            alert("บันทึกเรียบร้อยแล้ว");
                            location.reload();
                        }
                    }
                });
            }
        }
    });
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'ค่าพิเศษนึ่งยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;

if ($Role == 'IT' || $Role == 'PS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
    <input hidden class="role" value="<?php echo $sys ?>">
    <div class="bicycletire-info-index">
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
                        return ['id' => ArrayHelper::getValue($model, 'check')];
                    },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => [
                                'class' => 'text-center',
                            ],
                            'contentOptions' => function ($model) {
                                if (ArrayHelper::getValue($model, 'check') !== 0) {
                                    return ['class' => 'text-center', 'style' => 'visibility: hidden'];
                                } else {
                                    return ['class' => 'text-center'];
                                }
                            },
                            'checkboxOptions' => function ($model) {
                                $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date');
                                return ['value' => $data];
                            }
                        ],
                        'empid:text:รหัสพนักงาน',
                        'empname:text:ชื่อ - นามสกุล',
                        'date:date:วันที่',
                        'hour:text:ชั่วโมง',
                        'standard:text:มาตรฐาน',
                        //'tireamount1:integer:ยอดนึ่งเตา 1',
                        //'losttime:integer:เสียเวลา : นาที',
                        //'totaltire1:integer:ยอดเตา 1',
                        //'tireperpcs:text:ราคา : เส้น',
                        //'tirerate1:integer:ค่าพิเศษเตา 1',
                        //'tireamount2:integer:ยอดเตา 2',
                        //'tirerate2:integer:ค่าพิเศษเตา 2',
                        //'stickername:text:รายการสติกเกอร์',
                        //'stickeramount:integer:ติดสติกเกอร์',
                        //'stickerperpcs:text:ราคา : ดวง',
                        //'stickerrate:integer:ค่าติดสติกเกอร์',
                        'deduct:integer:หักเงิน',
                        'totalrate:integer:ค่าพิเศษ',
                        [
                            'attribute' => 'check',
                            'format' => 'raw',
                            'label' => 'สถานะ',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'value' => function ($model) {
                                return ArrayHelper::getValue($model, 'check') == 0 ? '<label class="label label-info">Created</label>' : '<label class="label label-success">Approved</label>';
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0)', [
                                        "id" => "viewmodal",
                                        "data-url" => $url,
                                        "value" => ArrayHelper::getValue($model, 'check') . ":" . ArrayHelper::getValue($model, 'empid') . "|" . ArrayHelper::getValue($model, 'date'),
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    if (ArrayHelper::getValue($model, 'check') == '0') {
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
                                $url = 'index.php?r=bicycletireinfo/' . $action . '&empid=' . $empid . '&date=' . $date;
                                return $url;
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
$res = Yii::$app->session->getFlash('res');

Modal::begin([
    "id" => "modal-view",
    "size" => "modal-lg"
]);
echo '<div class="modalContent"></div>';
echo '<div class="modal-footer" style="text-align: center">
        <button type="button" class="btn btn-success approved" style="width: 300px">ยืนยันข้อมูล</button>
</div>';
Modal::end();

$js = <<<JS
var txt = "$res";
if (txt !== "") { alert(txt); }

$(document).on("click","#viewmodal",function() {
    // alert($(this).attr("data-url"));
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
    // alert($(".role").val());
    var role = $(".role").val();
    if (role == 1) {
        $.ajax({
        type: 'post',
        url: '?r=bicycletireinfo/setapproved',
        data: {obj:$(this).val()},
        success: function(data) {
            if (data != 1) {
                alert("บันทึกไม่สำเร็จ ...");
                location.reload();
            } else {
                alert("บันทึกเรียบร้อย");
                location.reload();
            }
        }
        });
    } else {
        alert('ไม่สามารถยืนยันรายการได้เนื่องจากไม่มีสิทธิ์');
    }
});
JS;
$this->registerJs($js, static::POS_END);
?>