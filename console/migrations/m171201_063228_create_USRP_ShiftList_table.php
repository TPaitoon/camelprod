<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_ShiftList`.
 */
class m171201_063228_create_USRP_ShiftList_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_ShiftList', [
            'id' => $this->primaryKey(),
            'shiftname' => $this->string()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_ShiftList');
    }
}
