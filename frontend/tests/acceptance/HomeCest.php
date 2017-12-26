<?php
namespace frontend\tests\acceptance;

use Codeception\Template\Acceptance;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(Acceptance $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Company');

        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened

        $I->see('This is the About page.');
    }
}
