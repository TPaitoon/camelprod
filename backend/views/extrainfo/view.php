<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ค่ามาตรฐานเตา BOM', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ExtraName',
            'extra_id',
            'Values',
        ],
    ]) ?>

</div>
