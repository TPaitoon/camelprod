<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIBCEmplist`.
 */
class m180222_023308_create_USRP_PIBIBCEmplist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIBCEmplist', [
            'id' => $this->primaryKey(),
            'shift' => $this->integer(),
            'group' => $this->integer(),
            'empid' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIBCEmplist');
    }
}
