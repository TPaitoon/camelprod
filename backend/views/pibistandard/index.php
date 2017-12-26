<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibistandardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'มาตรฐานประกอบยางใน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibistandard-index">
    <div class="box box-primary box-solid">
        <div class="box-header"></div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'name:raw:มาตรฐาน',
                    'hour:raw:ชั่วโมง',
                    'amount:raw:เป้าหมาย',
                    'rate:raw:ค่าพิเศษ'
                    //'refid',

                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
