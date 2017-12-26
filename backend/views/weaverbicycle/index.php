<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WeaverbicycleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weaverbicycles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weaverbicycle-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary box-solid">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'sizename',
                    'groups',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
