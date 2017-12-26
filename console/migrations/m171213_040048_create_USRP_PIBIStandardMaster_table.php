<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIStandardMaster`.
 */
class m171213_040048_create_USRP_PIBIStandardMaster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIStandardMaster', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'refid' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIStandardMaster');
    }
}
