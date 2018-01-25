<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBICalculator`.
 */
class m180125_063022_create_USRP_PIBIMCMasrt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIMCMaster', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'group' => $this->integer()->notNull(),
            'shift' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIMCMaster');
    }
}
