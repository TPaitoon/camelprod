<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 06/07/2017
 * Time: 3:36 PM
 */

namespace backend\models;


class CheckDebug
{
    function printr($ob)
    {
        print "<pre>";
        print_r($ob);
        print "</pre>";
    }
}