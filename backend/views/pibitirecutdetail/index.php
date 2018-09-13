<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitirecutdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าพิเศษประกอบยางในดำ';
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash('res');
?>
<div class="pibitirecutdetail-index">
    <input hidden class="role" value="<?= $role ?>">
    <div class="panel">
        <div class="panel-heading">
            <?= $this->render("_search", ["model" => $searchModel]) ?>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'pager' => [
                    'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                ],
                'options' => [
                    'id' => 'grid'
                ],
                'rowOptions' => function ($model) {
                    return ['id' => ArrayHelper::getValue($model, 'status')];
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'empno:raw:รหัสพนักงาน',
                    'empname:raw:ชื่อ - นามสกุล',
                    'date:raw:วันที่',
                    'stdid:raw:ตำแหน่ง',
                    'status:raw:สถานะ',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
