<?php

use yii\db\Migration;

class m171213_091547_addvalue_USRP_PIBIStandardMaster extends Migration
{
    public function safeUp()
    {
        $this->insert('USRP_PIBIStandardMaster', array('name' => '1ฝา', 'refid' => 1));
        $this->insert('USRP_PIBIStandardMaster', array('name' => '2ฝา', 'refid' => 2));
        $this->insert('USRP_PIBIStandardMaster', array('name' => '3ฝา', 'refid' => 3));
        $this->insert('USRP_PIBIStandardMaster', array('name' => '4ฝา', 'refid' => 4));
        $this->insert('USRP_PIBIStandardMaster', array('name' => '5ฝา', 'refid' => 5));
        $this->insert('USRP_PIBIStandardMaster', array('name' => 'NR1ฝา', 'refid' => 6));
        $this->insert('USRP_PIBIStandardMaster', array('name' => 'NR2ฝา', 'refid' => 7));
        $this->insert('USRP_PIBIStandardMaster', array('name' => 'NR3ฝา', 'refid' => 8));
        $this->insert('USRP_PIBIStandardMaster', array('name' => 'NR4ฝา', 'refid' => 9));
        $this->insert('USRP_PIBIStandardMaster', array('name' => 'NR5ฝา', 'refid' => 10));
    }

    public function safeDown()
    {
        echo "m171213_091547_addvalue_USRP_PIBIStandardMaster cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171213_091547_addvalue_USRP_PIBIStandardMaster cannot be reverted.\n";

        return false;
    }
    */
}
