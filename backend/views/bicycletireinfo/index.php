<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BicycletireinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$js = <<<JS
    function chkdelete() {
      return confirm('ต้องการลบข้อมูล ?');
    }
    
    $("#binfo").on('click',function(e) {
        e.preventDefault();
            if (confirm('ต้องการยืนยันข้อมูล ?')) {
                var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
          
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
    });
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'Calculator Bicycletire';
$this->params['breadcrumbs'][] = $this->title;

if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
<div class="bicycletire-info-index">
    <div class="box box-primary box-solid">
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel, 'Role' => $sys]); ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last'
                ],
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
                    'empid:text:รหัสพนักงาน',
                    'empname:text:ชื่อ - นามสกุล',
                    'date:date:วันที่',
                    'hour:text:ชั่วโมง',
                    'standard:text:มาตรฐาน',
                    //'tireamount1:integer:ยอดนึ่งเตา 1',
                    //'losttime:integer:เสียเวลา : นาที',
                    'totaltire1:integer:ยอดเตา 1',
                    //'tireperpcs:text:ราคา : เส้น',
                    'tirerate1:integer:ค่าพิเศษเตา 1',
                    'tireamount2:integer:ยอดเตา 2',
                    'tirerate2:integer:ค่าพิเศษเตา 2',
                    //'stickername:text:รายการสติกเกอร์',
                    'stickeramount:integer:ติดสติกเกอร์',
                    //'stickerperpcs:text:ราคา : ดวง',
                    'stickerrate:integer:ค่าติดสติกเกอร์',
                    'deduct:integer:หักเงิน',
                    'totalrate:integer:ค่าพิเศษทั้งหมด',
                    [
                        'attribute' => 'check',
                        'format' => 'raw',
                        'label' => 'สถานะ'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'buttons' => [
                            'view' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, []);
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
                                $url = 'index.php?r=bicycletireinfo/view&empid=' . $empid . '&date=' . $date;
                                return $url;
                            }
                            if ($action == 'update') {
                                $url = 'index.php?r=bicycletireinfo/update&empid=' . $empid . '&date=' . $date;
                                return $url;
                            }
                            if ($action == 'delete') {
                                $url = 'index.php?r=bicycletireinfo/delete&empid=' . $empid . '&date=' . $date;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
