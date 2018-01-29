<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 29/01/2018
 * Time: 09:32 AM
 */

use yii\helpers\ArrayHelper;

/* @var $model backend\models\PIBIMCDetail */
/* @var $this yii\web\View */

$id = explode(',', ArrayHelper::getValue($model, 'recid'));
$this->title = 'ข้อมูล : ' . $id[0];
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางนอกมตซ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pibimccalculator-update">
    <div class="panel">
        <div class="panel panel-heading">
            <h4>แก้ไขข้อมูล</h4>
        </div>
        <div class="panel panel-body">
            <?= $this->render("_form", ['model' => $model]) ?>
        </div>
    </div>
</div>
