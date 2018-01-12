<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StandardbicycleEx */

$this->title = 'มาตรฐานรายละเอียดยาง';
$this->params['breadcrumbs'][] = ['label' => 'มาตรฐานรายละเอียดยาง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="standardbicycle-ex-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
