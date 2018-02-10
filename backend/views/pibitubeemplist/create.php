<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITubeEmplist */

$this->title = 'Create Pibitube Emplist';
$this->params['breadcrumbs'][] = ['label' => 'Pibitube Emplists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibitube-emplist-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
