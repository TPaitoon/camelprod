<?php

/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCStandardDetail */

$this->title = 'มาตรฐานประกอบยางในมตซ.';
$this->params['breadcrumbs'][] = ['label' => 'มาตรฐานประกอบยางในมตซ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูลมาตรฐาน';

?>

<div class="pibimcstandard-create">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>เพิ่มข้อมูลมาตรฐาน</h4>
        </div>
        <div class="panel panel-body">
            <?= $this->render('_formmaster', ['model' => $model]) ?>
        </div>
    </div>
</div>
