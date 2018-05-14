<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $model common\models\PIBITireOut */

$this->title = 'ค่าพิเศษออกยางแทน.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษออกยางแทน.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
    <div class="pibitire-out-create">
        <div class="panel">
            <div class="panel-body">
                <?= $this->render('_form', [
                    'model' => $model,
                    'status' => $status,
                    'action' => 1
                ]) ?>
            </div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <?= $this->render('_miniform') ?>
            </div>
        </div>
    </div>
<?php
$Baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($Baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>