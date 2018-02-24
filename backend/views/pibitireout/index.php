<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibitireoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าพิเศษออกยางแทน.';
$this->params['breadcrumbs'][] = $this->title;
?>
<input hidden class="role" value="<?php /* $role */ ?>">
<div class="pibitireout-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?php /* wait */ ?>
        </div>
        <div class="panel panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'empid',
                    'empname',
                    'shift',
                    'qty',
                    // 'status',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
