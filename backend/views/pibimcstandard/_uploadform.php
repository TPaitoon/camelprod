<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PIBIMCStandardMaster */
/* @var $form yii\widgets\ActiveForm */
/** PHPExcel */

/** PHPExcel_IOFactory - Reader */


$inputFileName = "C:/Users/paitoon.j/Documents/Book1.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setReadDataOnly(true);
$objPHPExcel = $objReader->load($inputFileName);


// for No header
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$r = -1;
$namedDataArray = array();
for ($row = 1; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        $namedDataArray[$r] = $dataRow[$row];
    }
}

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach ($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}

//echo '<pre>';
//var_dump($namedDataArray);
//echo '</pre><hr />';

?>
<!--table width="500" border="1">
    <!--tr>
        <td>REFID</td>
        <td>REFID NUMBER</td>
        <td>HOUR</td>
        <td>A1</td>
        <td>B1</td>
        <td>HOUR</td>
        <td>A2</td>
        <td>B2</td>
        <td>HOUR</td>
        <td>A3</td>
        <td>B3</td>
        <td>HOUR</td>
        <td>A4</td>
        <td>B4</td>
        <td>HOUR</td>
        <td>A5</td>
        <td>B5</td>
    </tr-->
<?php
$valueArray = [];
$i = 1;
foreach ($namedDataArray as $result) {
    array_push($valueArray, ['RF' => $i, 'HR1' => 8, 'A1' => $result["A1"], 'B1' => $result["B1"], 'HR2' => 9, 'A2' => $result["A2"], 'B2' => $result["B2"], 'HR3' => 10, 'A3' => $result["A3"], 'B3' => $result["B3"], 'HR4' => 11, 'A4' => $result["A4"], 'B4' => $result["B4"], 'HR5' => 12, 'A5' => $result["A5"], 'B5' => $result["B5"]]);
    $i++;
}
//    print_r($valueArray);
//for ($z = 0; $z < count($valueArray); $z++) {
//    for ($x = 1; $x <= 5; $x++) {
//        $model = new \common\models\PIBIMCStandardDetail();
//        $model->refid = ArrayHelper::getValue($valueArray[$z], 'RF');
//        $model->hour = ArrayHelper::getValue($valueArray[$z], 'HR' . $x);
//        $model->amount = ArrayHelper::getValue($valueArray[$z], 'A' . $x);
//        $model->rate = ArrayHelper::getValue($valueArray[$z], 'B' . $x);
//        $model->save(false);
//    }
//}

echo 'ok';
?>
<!--/table-->
<!--div class="upload-form"-->
<!--?php $form = ActiveForm::begin(['options' => ['enctype' => 'mulipart/form-data']]) ?-->
<!--?= $form->field($model, 'upload')->fileInput(['id' => 'uploadf', 'multiple' => true]) ?-->
<!--button type="button" class="btn btn-success click">Click</button-->
<!--?php ActiveForm::end() ?-->
<!--/div-->