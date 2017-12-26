<?php
/* @var $this yii\web\View */

use backend\models\Userinfo;

$this->title = '';

$usr = Userinfo::find()->where(['username' => Yii::$app->user->identity->username])->one();
if (count($usr) > 0) {
    if ($usr->Dept === 'PTVT') {
        //Yii::$app->response->redirect('index.php?r=bominfo');
    } elseif ($usr->Dept === 'PTBT') {
        Yii::$app->response->redirect('index.php?r=bicycleinfo');
    }
}
?>

