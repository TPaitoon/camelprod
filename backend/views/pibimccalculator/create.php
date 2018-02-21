<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 26/01/2018
 * Time: 14:46 PM
 */

use yii\web\JqueryAsset;

/** @var $this yii\web\View */

$this->title = 'ค่าพิเศษประกอบยางในมตซ.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางในมตซ.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
    <div class="pibimccalculator-create">
        <div class="panel">
            <div class="panel panel-heading">
                <h4>เพิ่มข้อมูล</h4>
            </div>
            <div class="panel panel-body">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . "/js/pibimc/shiftselectline-mc.js?Ver=0001", ["depends" => JqueryAsset::className()]);
?>