<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBITubeMaster`.
 */
class m180203_043825_create_USRP_PIBITubeMaster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBITubeMaster', [
            'id' => $this->primaryKey(),
            'shift' => $this->integer(),
            'date' => $this->date(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBITubeMaster');
    }
}
