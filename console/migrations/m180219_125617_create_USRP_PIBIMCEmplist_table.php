<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIMCEmplist`.
 */
class m180219_125617_create_USRP_PIBIMCEmplist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIMCEmplist', [
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
        $this->dropTable('USRP_PIBIMCEmplist');
    }
}
