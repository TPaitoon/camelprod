<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_Type`.
 */
class m171124_073056_create_USRP_TypeQty_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_TypeQty', [
            'id' => $this->primaryKey(),
            'typeid' => $this->integer()->notNull(),
            'typename' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_TypeQty');
    }
}
