<?php

use yii\db\Migration;

/**
 * Handles the creation of table `LoginHistory`.
 */
class m170814_033530_create_LoginHistory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_LoginHistory', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'log_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_LoginHistory');
    }
}
