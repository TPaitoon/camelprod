<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Weaverbicycle */

$this->title = 'Create Weaverbicycle';
$this->params['breadcrumbs'][] = ['label' => 'Weaverbicycles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weaverbicycle-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
