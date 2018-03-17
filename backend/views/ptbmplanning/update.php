<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 16/03/2018
 * Time: 9:50
 */

/**
 * @var $this yii\web\View
 * @var $model common\models\PTBMPlanning
 */

?>
<div class="ptbmplanning-update">
    <?= $this->render("_form", ["model" => $model, 'statusinfo' => $statusinfo]) ?>
</div>