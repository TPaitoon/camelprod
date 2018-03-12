<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PTBMPlanning`.
 */
class m180309_024732_create_USRP_PTBMPlanning_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PTBMPlanning', [
            'id' => $this->primaryKey(),
            'wrno' => $this->integer(),
            'date' => $this->dateTime(),
            'asset' => $this->string(),
            'group' => $this->string(),
            'itemid' => $this->integer(),
            'child_itemid' => $this->integer(),
            'child_desc' => $this->string(),
            'desc' => $this->string(),
            'assy_Frame' => $this->integer(),
            'assy_Weight' => $this->float(),
            'qty' => $this->integer(),
            'status' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PTBMPlanning');
    }
}
