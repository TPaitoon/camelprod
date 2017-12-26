<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qry_EmpInfo".
 *
 * @property string $PRS_NO
 * @property string $PRI_START_D
 * @property integer $EMP_KEY
 * @property string $EMP_INTL
 * @property string $EMP_NAME
 * @property string $EMP_SURNME
 * @property string $EMP_E_NAME
 * @property integer $EMP_GENDER
 * @property string $EMP_I_CARD
 * @property string $EMP_I_EXPIRE
 * @property string $EMP_EMAIL
 * @property string $PRS_E_CARD
 * @property string $JBT_THAIDESC
 * @property string $PRS_LOAN_C
 * @property integer $PRI_STATUS
 * @property integer $PRI_SAL_TY
 * @property string $EMP_BIRTH
 * @property string $PRI_SALARY
 * @property string $Dept
 * @property string $Sec
 * @property string $DEPT_CODE_Dept
 * @property string $DEPT_CODE_Sec
 * @property string $DeptName
 * @property string $SecName
 * @property string $PRS_SC_HSTAL
 */
class EmpInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qry_EmpInfo';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_payroll');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRS_NO', 'PRI_START_D', 'EMP_KEY', 'EMP_INTL', 'EMP_NAME', 'EMP_SURNME', 'JBT_THAIDESC', 'PRI_STATUS', 'PRI_SAL_TY', 'PRI_SALARY', 'Dept', 'Sec', 'DEPT_CODE_Dept', 'DEPT_CODE_Sec', 'DeptName', 'SecName'], 'required'],
            [['PRS_NO', 'EMP_INTL', 'EMP_NAME', 'EMP_SURNME', 'EMP_E_NAME', 'EMP_I_CARD', 'EMP_EMAIL', 'PRS_E_CARD', 'JBT_THAIDESC', 'PRS_LOAN_C', 'Dept', 'Sec', 'DEPT_CODE_Dept', 'DEPT_CODE_Sec', 'DeptName', 'SecName', 'PRS_SC_HSTAL'], 'string'],
            [['PRI_START_D', 'EMP_I_EXPIRE', 'EMP_BIRTH'], 'safe'],
            [['EMP_KEY', 'EMP_GENDER', 'PRI_STATUS', 'PRI_SAL_TY'], 'integer'],
            [['PRI_SALARY'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PRS_NO' => 'Prs  No',
            'PRI_START_D' => 'Pri  Start  D',
            'EMP_KEY' => 'Emp  Key',
            'EMP_INTL' => 'Emp  Intl',
            'EMP_NAME' => 'Emp  Name',
            'EMP_SURNME' => 'Emp  Surnme',
            'EMP_E_NAME' => 'Emp  E  Name',
            'EMP_GENDER' => 'Emp  Gender',
            'EMP_I_CARD' => 'Emp  I  Card',
            'EMP_I_EXPIRE' => 'Emp  I  Expire',
            'EMP_EMAIL' => 'Emp  Email',
            'PRS_E_CARD' => 'Prs  E  Card',
            'JBT_THAIDESC' => 'Jbt  Thaidesc',
            'PRS_LOAN_C' => 'Prs  Loan  C',
            'PRI_STATUS' => 'Pri  Status',
            'PRI_SAL_TY' => 'Pri  Sal  Ty',
            'EMP_BIRTH' => 'Emp  Birth',
            'PRI_SALARY' => 'Pri  Salary',
            'Dept' => 'Dept',
            'Sec' => 'Sec',
            'DEPT_CODE_Dept' => 'Dept  Code  Dept',
            'DEPT_CODE_Sec' => 'Dept  Code  Sec',
            'DeptName' => 'Dept Name',
            'SecName' => 'Sec Name',
            'PRS_SC_HSTAL' => 'Prs  Sc  Hstal',
        ];
    }
}
