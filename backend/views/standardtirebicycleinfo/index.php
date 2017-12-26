<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StandardtirebicycleinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Standard TireBicycle & Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="standard-tire-bicycle-info-index">
    <div class="box box-primary box-solid">
        <div class="box-body">
            <div class="col-lg-4">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'standardname:text:มาตรฐาน',
                        'idexbicycle:integer:กลุ่ม',
                        //'class','min'
                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]) ?>
            </div>
            <div class="col-lg-8">
                <?= GridView::widget([
                    'dataProvider' => $detailProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'steamName',
                        'idexbicycle:integer:กลุ่ม',
                        'hourwork:integer:ชั่วโมง',
                        'valuemin:integer:ค่าต่ำสุด',
                        'valuemax:text:ค่าสูงสุด',
                        'rate:text:ค่าพิเศษ'
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
