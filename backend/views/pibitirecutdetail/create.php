<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTDETAIL */

$this->title = 'Create Pibitirecutdetail';
$this->params['breadcrumbs'][] = ['label' => 'Pibitirecutdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitirecutdetail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
