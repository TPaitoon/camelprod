<?php

use yii\db\Migration;

class m171124_093552_add_data_USRP_TypeQty_table extends Migration
{
    public function safeUp()
    {
        $this->insert('USRP_TypeQty', array('typeid' => '1', 'typename' => 'ยอดยาง (ก่อนนึ่ง)'));
        $this->insert('USRP_TypeQty', array('typeid' => '2', 'typename' => 'ราคา : เส้น'));
        $this->insert('USRP_TypeQty', array('typeid' => '3', 'typename' => 'ค่าพิเศษ'));
//        $this->insert('USRP_TypeQty', array('typeid' => '2', 'typename' => 'หักยางเสีย (ก่อนนึ่ง)'));
//        $this->insert('USRP_TypeQty', array('typeid' => '3', 'typename' => 'หักยางเสีย (หลังนึ่ง)'));
//        $this->insert('USRP_TypeQty', array('typeid' => '4', 'typename' => 'หักจุ๊บเสีย'));
    }

    public function safeDown()
    {
        echo "m171124_093552_add_data_USRP_TypeQty_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171124_093552_add_data_USRP_TypeQty_table cannot be reverted.\n";

        return false;
    }
    */
}
