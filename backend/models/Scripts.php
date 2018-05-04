<?php
/**
 * Created by PhpStorm.
 * User: paitoon.j
 * Date: 04/05/2018
 * Time: 10:38
 */

namespace backend\models;


use common\models\EmpInfo;

class Scripts
{
    public static function ConvertDateDMYtoYMDforSQL($date)
    {
        $_temp = str_replace("/", "-", $date);
        return date("Y-m-d", strtotime($_temp));
    }

    public static function ConvertDateYMDtoDMYforForm($date)
    {
        $_temp = str_replace("-", "/", $date);
        return date("d/m/Y", strtotime($_temp));
    }

    public static function ShowEmpname($empid)
    {
        $query = EmpInfo::findOne(["PRS_NO" => $empid]);
        return $query->EMP_NAME . " " . $query->EMP_SURNME;
    }
}