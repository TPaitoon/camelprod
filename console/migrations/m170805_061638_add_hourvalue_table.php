<?php

use yii\db\Migration;

class m170805_061638_add_hourvalue_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('USRS_hour', 'values', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('USRS_hour', 'values');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170805_061638_add_hourvalue_table cannot be reverted.\n";

        return false;
    }
    */
}
