<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIMCStandardDetail`.
 */
class m180124_091609_create_USRP_PIBIMCStandardDetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIMCStandardDetail', [
            'id' => $this->primaryKey(),
            'refid' => $this->integer(),
            'hour' => $this->integer(),
            'amount' => $this->integer(),
            'rate' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIMCStandardDetail');
    }
}
