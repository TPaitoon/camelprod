<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitirecutstandardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'มาตรฐานประกอบยางในดำ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitirecutstandard-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'rate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
