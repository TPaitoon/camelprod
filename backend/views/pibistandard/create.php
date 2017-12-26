<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBIStandard */

$this->title = 'Create Pibistandard';
$this->params['breadcrumbs'][] = ['label' => 'Pibistandards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibistandard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
