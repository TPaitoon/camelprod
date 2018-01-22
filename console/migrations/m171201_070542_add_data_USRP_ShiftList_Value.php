<?php

use yii\db\Migration;

class m171201_070542_add_data_USRP_ShiftList_Value extends Migration
{
    public function safeUp()
    {
        $this->insert('USRP_ShiftList', array('shiftname' => 'กลางวัน'));
        $this->insert('USRP_ShiftList', array('shiftname' => 'กลางคืน'));
    }

    public function safeDown()
    {
        echo "m171201_070542_add_data_USRP_ShiftList_Value cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171201_070542_add_data_USRP_ShiftList_Value cannot be reverted.\n";

        return false;
    }
    */
}
