<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBITubeEmplist`.
 */
class m180210_064857_create_USRP_PIBITubeEmplist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBITubeEmplist', [
            'id' => $this->primaryKey(),
            'shift' => $this->integer(),
            'date' => $this->date(),
            'empid' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBITubeEmplist');
    }
}
