<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('Fix');
        $I->seeLink('Components');
        $I->click('Components');
        $I->see('CPU');
    }
}