<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StandardTireBicycleInfo */

$this->title = 'Create Standard Tire Bicycle Info';
$this->params['breadcrumbs'][] = ['label' => 'Standard Tire Bicycle Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="standard-tire-bicycle-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
