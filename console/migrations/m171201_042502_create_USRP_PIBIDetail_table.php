<?php

use yii\db\Migration;

/**
 * Handles the creation of table `USRP_PIBIDetail`.
 */
class m171201_042502_create_USRP_PIBIDetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('USRP_PIBIDetail', [
            'id' => $this->primaryKey(),
            'Groupid' => $this->integer()->notNull(),
            'Shiftid' => $this->integer()->notNull(),
            'Empid' => $this->string()->notNull(),
            'Date' => $this->date()->notNull(),
            'Hour' => $this->integer()->notNull(),
            'Typeid' => $this->integer()->notNull(),
            'Qty' => $this->double()->notNull(),
            'Itemid' => $this->integer()->notNull(),
            'Deduct' => $this->double()->notNull(),
            'Totaltire' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('USRP_PIBIDetail');
    }
}
