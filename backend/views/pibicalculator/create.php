<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 13/01/2018
 * Time: 10:29 AM
 */

use yii\web\JqueryAsset;

$this->title = 'ค่าพิเศษประกอบยางในจกย.';
$this->params['breadcrumbs'][] = ['label' => 'ค่าพิเศษประกอบยางในจกย.', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'เพิ่มข้อมูล';
?>
    <div class="pibicalculator-create">
        <div class="panel">
            <div class="panel panel-heading">
                <h4>เพิ่มข้อมูล</h4>
            </div>
            <div class="panel panel-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerJsFile($baseurl . "/js/pibi/shiftselectline-bc.js?Ver=0001", ["depends" => JqueryAsset::className()]);
?>