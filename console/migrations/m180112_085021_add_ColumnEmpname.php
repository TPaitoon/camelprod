<?php

use yii\db\Migration;

class m180112_085021_add_ColumnEmpname extends Migration
{
//    public function safeUp()
//    {
//
//    }
//
//    public function safeDown()
//    {
//        echo "m180112_085021_add_ColumnEmpname cannot be reverted.\n";
//
//        return false;
//    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('USRP_PIBIDetail','Empname',$this->string()->after('Empid'));
    }

    public function down()
    {
        echo "m180112_085021_add_ColumnEmpname cannot be reverted.\n";

        return false;
    }
}
