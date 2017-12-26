<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StandardbicycleexSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Tire & Details';
$this->params['breadcrumbs'][] = 'รายการยางและมาตรฐาน';
?>
<div class="standardbicycle-ex-index">
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary box-solid">
        <div class="box-body">
            <div class="col-lg-6">
                <?= GridView::widget(['dataProvider' => $tireProvider,
                    'columns' => [['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'sizename:text:รายการยาง',
                        'groups:integer:กลุ่ม',

                        ],]); ?>
            </div>
            <div class="col-lg-6">
                <?= GridView::widget(['dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'average:integer:ค่าเฉลี่ย',
                        'groups:integer:กลุ่ม',
                        'amountWork:integer:จำนวณชั่วโมง',
                        'valueMin:integer:มาตรฐานขั้นต่ำ',
                        'valueMax:integer:มาตรฐานสูงสุด',
                        'Rate:text:ค่าพิเศษ',

                        ],]); ?>
            </div>
        </div>
    </div>
</div>
