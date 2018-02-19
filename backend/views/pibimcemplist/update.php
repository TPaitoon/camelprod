<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCEmplist */

$this->title = 'Update Pibimcemplist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pibimcemplists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pibimcemplist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
