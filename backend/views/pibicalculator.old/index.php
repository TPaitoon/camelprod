<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibicalculatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าพิเศษประกอบยางในจกย.';
$this->params['breadcrumbs'][] = $this->title;

if ($Role == 'ITIT' || $Role == 'PSPS') {
    $sys = 1;
} else {
    $sys = 0;
}

?>
<div class="pibicalculator-index">
    <div class="box box-primary box-solid">
        <div class="box-header"></div>
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel, 'Role' => $sys]); ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => '<<',
                    'lastPageLabel' => '>>'
                ],
                'options' => [
                    'id' => 'grid'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'checkboxOptions' => function ($model) {
                            return ['value' => 0];
                        }
                    ],
                    'group:raw:กลุ่ม',
                    'shift:raw:เข้ากะ',
                    'empid:text:รหัสพนักงาน',
                    'empname:text:ชื่อ - นามสกุล',
                    'date:date:วันที่',
                    'hour:integer:ชั่วโมง',
                    'std:text:มาตรฐาน',
                    'amount:integer:ยอดยาง (ก่อนนึ่ง)',
                    'totaltire:integer:ยอดยาง (หลังนึ่ง)',
                    'deduct:raw:หักเงิน',
                    'rate:raw:ค่าพิเศษ : วัน',
                    'status:raw:สถานะ',
                    [
                        'class' => 'yii\grid\ActionColumn'
                    ],
                ]
            ])
            ?>
        </
        div >
    </div>
</div>
