<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIDetail`.
 */
class m180113_022235_create_USRP_PIBIDetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIDetail', [
            'id' => $this->primaryKey(),
            'Empid' => $this->string(),
            'Empname' => $this->string(),
            'Date' => $this->date(),
            'Hour' => $this->integer(),
            'Typeid' => $this->integer(),
            'TQty' => $this->double(),
            'Deductid' => $this->integer(),
            'DQty' => $this->double(),
            'Rate' => $this->integer(),
            'Refid' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIDetail');
    }
}
