<?php

use backend\models\CheckDebug;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

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
                        cache: false,
                        success: function() {
                            alert('ลบเรียบร้อยแล้ว');
                            location.reload();
                        }
                    });
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
                        location.reload();
                    }
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

/*$debug = new CheckDebug();
$debug->printr($dataProvider);
return;*/

if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}

//echo Yii::$app->formatter->asDate(str_replace('/','-','20/10/2017'),'yyyy-MM-dd');
?>
<input hidden class="role" value="<?php echo $sys ?>">
<div class="bominfo-index">
    <div class="box box-primary box-solid">
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
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
                    'amount:integer:ยอดนึ่ง',
                    'losttime:integer:เสียเวลา : นาที',
                    'totaltire:integer:ยอดยาง',
                    'priceperpcs:text:ราคา : เส้น',
                    'deduct:integer:หักเงิน',
                    'rate:text:ค่าพิเศษ : วัน',
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
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url,$model) {
                                if (ArrayHelper::getValue($model,'check') == 'Created') {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, []);

                                } else {
                                    if (ArrayHelper::getValue($model,'role') == '1') {
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

                            if ($action == 'update') {
                                $url = 'index.php?r=bominfo/update&empid=' . $empid . '&date=' . $date . '&stoveid=' . $stoveid;
                                return $url;
                            }
                            if ($action == 'delete') {
                                $url = 'index.php?r=bominfo/delete&empid=' . $empid . '&date=' . $date . '&stoveid=' . $stoveid;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
