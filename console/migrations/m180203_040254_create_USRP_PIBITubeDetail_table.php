<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBITube`.
 */
class m180203_040254_create_USRP_PIBITubeDetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBITubeDetail', [
            'id' => $this->primaryKey(),
            'empid' => $this->string(),
            'empname' => $this->string(),
            'date' => $this->date(),
            'shift' => $this->integer(),
            'itemid' => $this->integer(),
            'qty' => $this->integer(),
            'rate' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBITube');
    }
}
