<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->title = 'ค่าพิเศษพนักงานเตรียมจุ๊บ';
$this->params['breadcrumbs'][] = $this->title;
$res = Yii::$app->session->getFlash('res');
?>
<input hidden class="role" value="<?php echo $role ?>">
<div class="pibitubecalculator-index">
    <div class="panel">
        <div class="panel panel-heading">
            <?php echo $this->render('_search', ['model' => $searchModel]) ?>
        </div>
    </div>
</div>