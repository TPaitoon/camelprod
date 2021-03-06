<?php

use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;

$id = explode(',', ArrayHelper::getValue($model, 'recid'));
$this->title = 'ข้อมูล : ' . $id[0];
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางในจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="pibicalculator-update">
        <div class="panel">
            <div class="panel panel-heading">
                <h4>แก้ไขข้อมูล</h4>
            </div>
            <div class="panel panel-body">
                <?= $this->render("_form", [
                    'model' => $model
                ]) ?>
            </div>
        </div>
    </div>
<?php
/* @var $this yii\web\View */
/* @var $model \backend\models\PIBIDetail */
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . "/js/pibi/editline.js?Ver=0001", ["depends" => JqueryAsset::className()]);
?>