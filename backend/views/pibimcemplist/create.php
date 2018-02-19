<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCEmplist */

$this->title = 'Create Pibimcemplist';
$this->params['breadcrumbs'][] = ['label' => 'Pibimcemplists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibimcemplist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
