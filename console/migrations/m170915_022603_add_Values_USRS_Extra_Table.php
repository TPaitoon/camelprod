<?php

use yii\db\Migration;

class m170915_022603_add_Values_USRS_Extra_Table extends Migration
{
//    public function safeUp()
//    {
//
//    }
//
//    public function safeDown()
//    {
//        echo "m170915_022603_add_Values_USRS_Extra_Table cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('USRS_Extra','Values',$this->integer());
    }

    public function down()
    {
        $this->dropColumn('USRS_Extra','Values');
    }

}
