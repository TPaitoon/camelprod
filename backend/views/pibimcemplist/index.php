<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibimcemplistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pibimcemplists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibimcemplist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pibimcemplist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shift',
            'group',
            'empid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
