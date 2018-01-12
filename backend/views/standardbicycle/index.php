<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StandardbicycleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่ามาตรฐานเงินประจำตำแหน่งประกอบยางนอกจกย.';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="standard-bicycle-index">
    <div class="box box-primary box-solid">
        <div class="box-body">
            <?= Html::a('เพิ่มเงินประจำตำแหน่ง', ['create'], ['class' => 'btn btn-success']) ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id:text:รหัส',
                    'Section:text:ตำแหน่ง',
                    'amount:integer:จำนวณเงิน',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'class' => 'text-center'
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'template' => '{update}{delete}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>