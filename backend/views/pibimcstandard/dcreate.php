<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 10/08/2018
 * Time: 15:37
 */

/* @var $this yii\web\View */
/* @var $model \common\models\PIBIMCStandardDetail */

$this->title = "Create PibimcStandard Detail";
$this->params['breadcrumbs'][] = ['label' => 'PibimcStandard', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibimcstandarddetail-create">
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
    <!--div class="panel">
        <div class="panel-body">
            <?= $this->render('_uploadform', [
                'model' => $model
            ]) ?>
        </div>
    </div-->
</div>