<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 13/01/2018
 * Time: 10:29 AM
 */

use yii\web\JqueryAsset;
$baseurl = Yii::$app->request->baseUrl;
$this->title = 'Create Pibicalculator';
$this->params['breadcrumbs'][] = ['label' => 'Pibicalculators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pibicalculator-create">
    <div class="panel">
        <div class="panel panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>