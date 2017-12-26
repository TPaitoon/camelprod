<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIStandardDetail`.
 */
class m171213_090825_create_USRP_PIBIStandardDetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIStandardDetail', [
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
        $this->dropTable('USRP_PIBIStandardDetail');
    }
}
