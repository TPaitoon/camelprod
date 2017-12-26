<?php

use yii\db\Migration;

class m170816_011845_add_valuesindepartment extends Migration
{
    public function safeUp()
    {
        $this->insert('USRP_Department', array('deptid' => 'CPCH', 'deptdesc' => 'เตรียมเคมี'));
        $this->insert('USRP_Department', array('deptid' => 'CPMX', 'deptdesc' => 'ผสมยาง'));
        $this->insert('USRP_Department', array('deptid' => 'DMDA', 'deptdesc' => 'ธุรการขายในประเทศ'));
        $this->insert('USRP_Department', array('deptid' => 'DMDL', 'deptdesc' => 'จัดส่งในประเทศ'));
        $this->insert('USRP_Department', array('deptid' => 'ENBU', 'deptdesc' => 'โครงการ / สร้าง'));
        $this->insert('USRP_Department', array('deptid' => 'ENEN', 'deptdesc' => 'วิศวกรรม'));
        $this->insert('USRP_Department', array('deptid' => 'ENEP', 'deptdesc' => 'ไฟฟ้า'));
        $this->insert('USRP_Department', array('deptid' => 'ENMT', 'deptdesc' => 'ซ่อมบำรุง'));
        $this->insert('USRP_Department', array('deptid' => 'ENUT', 'deptdesc' => 'สาธารณูปโภค'));
        $this->insert('USRP_Department', array('deptid' => 'EXEM', 'deptdesc' => 'ขายและการตลาดต่างประเทศ'));
        $this->insert('USRP_Department', array('deptid' => 'ITIT', 'deptdesc' => 'สารสนเทศ'));
        $this->insert('USRP_Department', array('deptid' => 'PCPU', 'deptdesc' => 'จัดซื้อ'));
        $this->insert('USRP_Department', array('deptid' => 'PCST', 'deptdesc' => 'สโตร์'));
        $this->insert('USRP_Department', array('deptid' => 'PIBI', 'deptdesc' => 'ประกอบยางใน'));
        $this->insert('USRP_Department', array('deptid' => 'PIPK', 'deptdesc' => 'บรรจุยางใน'));
        $this->insert('USRP_Department', array('deptid' => 'PIVI', 'deptdesc' => 'นึ่งยางใน'));
        $this->insert('USRP_Department', array('deptid' => 'PLFG', 'deptdesc' => 'คลังสินค้า'));
        $this->insert('USRP_Department', array('deptid' => 'PLPP', 'deptdesc' => 'วางแผนการผลิต'));
        $this->insert('USRP_Department', array('deptid' => 'PSPS', 'deptdesc' => 'บุคคล'));
        $this->insert('USRP_Department', array('deptid' => 'PTAB', 'deptdesc' => 'ประกอบยางแกน'));
        $this->insert('USRP_Department', array('deptid' => 'PTBT', 'deptdesc' => 'ประกอบยางนอก'));
        $this->insert('USRP_Department', array('deptid' => 'PTCN', 'deptdesc' => 'ตัดผ้าใบ'));
        $this->insert('USRP_Department', array('deptid' => 'PTEA', 'deptdesc' => 'ออกยางนอก'));
        $this->insert('USRP_Department', array('deptid' => 'PTNT', 'deptdesc' => 'เดินผ้าใบ'));
        $this->insert('USRP_Department', array('deptid' => 'PTPA', 'deptdesc' => 'บรรจุยางนอก'));
        $this->insert('USRP_Department', array('deptid' => 'PTVT', 'deptdesc' => 'นึ่งยางนอก'));
        $this->insert('USRP_Department', array('deptid' => 'PTWT', 'deptdesc' => 'เดินลวด'));
        $this->insert('USRP_Department', array('deptid' => 'QACL', 'deptdesc' => 'สอบเทียบ'));
        $this->insert('USRP_Department', array('deptid' => 'QAQC', 'deptdesc' => 'ควบคุมคุณภาพ'));
        $this->insert('USRP_Department', array('deptid' => 'QAQS', 'deptdesc' => 'ระบบคุณภาพ'));
        $this->insert('USRP_Department', array('deptid' => 'TNDD', 'deptdesc' => 'ออกแบบและพัฒนาผลิตภัณฑ์'));
        $this->insert('USRP_Department', array('deptid' => 'TNLB', 'deptdesc' => 'ห้องทดสอบ'));
        $this->insert('USRP_Department', array('deptid' => 'TNMO', 'deptdesc' => 'แม่พิมพ์'));
    }

    public function safeDown()
    {
        echo "m170816_011845_add_valuesindepartment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170816_011845_add_valuesindepartment cannot be reverted.\n";

        return false;
    }
    */
}
