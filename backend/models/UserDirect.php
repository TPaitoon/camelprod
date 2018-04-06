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

    public function ChkusrForPT()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'IT' && $usr !== 'PSP' && $usr !== 'PT') {
            return $app->response->redirect($app->homeUrl);
        }
        return $usr;
    }

    public function ChkusrForIT()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'IT') {
            return $app->response->redirect($app->homeUrl);
        }
    }

    public function ChkusrForAdmin()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'IT' && $usr !== 'PS') {
            return $app->response->redirect($app->homeUrl);
        }
    }

    public function ChkusrForPI()
    {
        $app = Yii::$app;
        $usr = $this->Chkusr();
        if ($usr !== 'IT' && $usr !== 'PS' && $usr !== 'PI') {
            return $app->response->redirect($app->homeUrl);
        }
        return $usr;
    }
}