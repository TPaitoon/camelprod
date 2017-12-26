<?php

use yii\db\Migration;

class m170805_071042_add_classandmin extends Migration
{
    public function safeUp()
    {
        $this->addColumn('USRS_standardtirebicycle', 'class', $this->integer());
        $this->addColumn('USRS_standardtirebicycle', 'min', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('USRS_standardtirebicycle', 'class');
        $this->dropColumn('USRS_standardtirebicycle', 'min');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170805_071042_add_classandmin cannot be reverted.\n";

        return false;
    }
    */
}
