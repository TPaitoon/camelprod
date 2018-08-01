<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 14/07/2018
 * Time: 14:42
 */

/* @var $this yii\web\View */
/* @var $model common\models\PIBIStandardDetail */

$this->title = "Create PibiStandard Detail";
$this->params['breadcrumbs'][] = ['label' => 'Pibistandards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibistanddetail-create">
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_dform', [
                'model' => $model
            ]) ?>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">
            <?= $this->render('_dminiform') ?>
        </div>
    </div>
</div>