<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $dataProvider */

$this->title = 'มาตรฐานประกอบยางในมตซ.';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="pibimcstandard-index">
        <div class="panel">
            <div class="panel panel-heading">
                <?= Html::a('เพิ่มข้อมูลมาตรฐาน', ['createmaster'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('เพิ่มข้อมูลรายละเอียด', ['dcreate'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="panel panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn'
                        ],
                        'name:raw:มาตรฐาน',
                        'hour:raw:ชั่วโมง',
                        'amount:raw:เป้าหมาย',
                        'rate:raw:ค่าพิเศษ'
                    ],
                ]) ?>
            </div>
        </div>
    </div>
<?php
$baseurl = Yii::$app->request->baseUrl;
$this->registerCssFile($baseurl . '/css/panel.css?Ver=0001', ['depends' => JqueryAsset::className()]);
?>