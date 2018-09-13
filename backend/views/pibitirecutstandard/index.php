<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitirecutstandardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'มาตรฐานประกอบยางในดำ';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/panel.css?ver=0001', ['depends' => \yii\web\JqueryAsset::className()]);
?>
<div class="pibitirecutstandard-index">
    <div class="box box-default box-solid">
        <div class="box-body">
            <?= Html::a("เพิ่มมาตรฐาน", ['create'], ['class' => 'btn btn-success']) ?>
            <hr>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'name:raw:มาตรฐาน',
                    'rate:raw:เงิน',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
