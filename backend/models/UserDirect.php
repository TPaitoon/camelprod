<?php
/**
 * Created by PhpStorm.
 * User: Paitoon
 * Date: 11/10/2017
 * Time: 11:36 AM
 */

namespace backend\models;


use Yii;
use yii\db\Exception;
use backend\models\Userinfo;

class UserDirect
{
    public function Chkusr()
    {
        $app = Yii::$app;
        if ($app->user->isGuest) {
            return $app->response->redirect($app->homeUrl);
        } else {
            try {
                $usr = Userinfo::find()->where(['username' => $app->user->identity->username])->one();
                if (count($usr) == 0) {
                    $app->user->logout();
                    return $app->response->redirect($app->homeUrl);
                }
            } catch (Exception $exception) {
                return $app->response->redirect($app->homeUrl);
            }
            return $usr->Dept;
        }
    }

    public function ChkusrForBOM()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'ITIT' && $usr !== 'PSPS' && $usr !== 'PTVT') {
            return $app->response->redirect($app->homeUrl);
        }
        return $usr;
    }

    public function ChkusrForIT()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'ITIT') {
            return $app->response->redirect($app->homeUrl);
        }
    }

    public function ChkusrForAdmin()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'ITIT' && $usr !== 'PSPS') {
            return $app->response->redirect($app->homeUrl);
        }
    }

    public function ChkusrForBicycle()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'ITIT' && $usr !== 'PSPS' && $usr !== 'PTBT') {
            return $app->response->redirect($app->homeUrl);
        }
        return $usr;
    }

    public function ChkusrForBicycletire()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'ITIT' && $usr !== 'PSPS' && $usr !== 'PTVT') {
            return $app->response->redirect($app->homeUrl);
        }
        return $usr;
    }

    public function ChkusrForPIBIMaster()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'ITIT' && $usr !== 'PSPS' && $usr !== 'PIBI') {
            return $app->response->redirect($app->homeUrl);
        }
        return $usr;
    }
}