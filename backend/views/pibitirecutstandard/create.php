<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITIRECUTSTANDARD */

$this->title = 'Create Pibitirecutstandard';
$this->params['breadcrumbs'][] = ['label' => 'Pibitirecutstandards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitirecutstandard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
