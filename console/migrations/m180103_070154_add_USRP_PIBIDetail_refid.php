<?php

use yii\db\Migration;

class m180103_070154_add_USRP_PIBIDetail_refid extends Migration
{
//    public function safeUp()
//    {
//
//    }

//    public function safeDown()
//    {
//        echo "m180103_070154_add_USRP_PIBIDetail_refid cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('USRP_PIBIDetail','refid',$this->integer());
    }

    public function down()
    {
        echo "m180103_070154_add_USRP_PIBIDetail_refid cannot be reverted.\n";

        return false;
    }
}
