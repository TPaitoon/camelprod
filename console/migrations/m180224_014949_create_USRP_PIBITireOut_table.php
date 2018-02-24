<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBITireOut`.
 */
class m180224_014949_create_USRP_PIBITireOut_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBITireOut', [
            'id' => $this->primaryKey(),
            'empid' => $this->string(),
            'empname' => $this->string(),
            'shift' => $this->integer(),
            'qty' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBITireOut');
    }
}
