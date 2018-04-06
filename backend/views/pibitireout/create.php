<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITireOut */

$this->title = 'ค่าพิเศษออกยางแทน.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษออกยางแทน.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitire-out-create">
    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status,
    ]) ?>
</div>
