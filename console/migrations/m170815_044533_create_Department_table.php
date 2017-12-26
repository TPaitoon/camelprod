<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Department`.
 */
class m170815_044533_create_Department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_Department', [
            'id' => $this->primaryKey(),
            'deptid' => $this->string()->notNull(),
            'deptdesc' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_Department');
    }
}
