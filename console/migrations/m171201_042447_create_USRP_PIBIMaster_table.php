<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIMaster`.
 */
class m171201_042447_create_USRP_PIBIMaster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIMaster', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull(),
            'group' => $this->integer()->notNull(),
            'shift' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIMaster');
    }
}
