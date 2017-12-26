<?php

use backend\models\CheckDebug;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BominfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$js = <<<JS
    
    function chkdelete() {
      return confirm('ต้องการลบข้อมูล ?');
    }
    
    $("#binfo").on('click',function(e) {
      e.preventDefault();
      var dataar = $('input[type=checkbox]:checked').map(function() {
                return $(this).val();
            }).get();
      
      if (confirm('ต้องการยืนยันข้อมูล ?')){
        $.ajax({
            type: 'post',
            url: '?r=bominfo/setapproved',
            data: {dataar:dataar},
            dataType: 'json',
            success: function(data) {
                if (data === 0) {
                    alert("บันทึกถูกยกเลิก");
                } else if (data === 1){
                    alert("บันทึกเรียบร้อยแล้ว");
                    location.reload();
                }
            }
        });
      }
    })    
JS;
$this->registerJs($js, static::POS_END);
$this->title = 'Calculator BOM';
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
<div class="bominfo-index">
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
                'options' => [
                    'id' => 'grid',
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
                            $data = ArrayHelper::getValue($model, 'empid') . "," . ArrayHelper::getValue($model, 'date') . "," . ArrayHelper::getValue($model, 'stoveid');
                            return ['value' => $data];
                        }
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
                    'check:raw:สถานะ',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center',
                        ],
                        'template' => '{update}{delete}',
                        'buttons' => [
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
