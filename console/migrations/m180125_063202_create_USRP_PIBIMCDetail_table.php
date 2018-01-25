<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIMCDetail`.
 */
class m180125_063202_create_USRP_PIBIMCDetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIMCDetail', [
            'id' => $this->primaryKey(),
            'shiftid' => $this->integer(),
            'groupid' => $this->integer(),
            'empid' => $this->string(),
            'empname' => $this->integer(),
            'date' => $this->date(),
            'hour' => $this->integer(),
            'itemid' => $this->integer(),
            'typeid' => $this->integer(),
            'qty' => $this->double(),
            'deduct' => $this->integer(),
            'refid' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIMCDetail');
    }
}
