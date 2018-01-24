<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIMCStandardMaster`.
 */
class m180124_091418_create_USRP_PIBIMCStandardMaster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIMCStandardMaster', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'refid' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIMCStandardMaster');
    }
}
