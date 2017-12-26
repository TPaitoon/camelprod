<?php

use yii\db\Migration;

class m170810_030840_create_userinfo_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('USRP_Userinfo', [
            'id' => $this->primaryKey(),
            'Firstname' => $this->string()->notNull(),
            'Lastname' => $this->string()->notNull(),
            'username' => $this->string()->notNull(),
            'Dept' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('USRP_Userinfo');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170810_030840_create_userinfo_table cannot be reverted.\n";

        return false;
    }
    */
}
