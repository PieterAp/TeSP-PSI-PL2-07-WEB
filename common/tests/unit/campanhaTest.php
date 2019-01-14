<?php namespace common\tests;

use common\models\Campanha;

class campanhaTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testValidation()
    {
        $campanha = new Campanha();

        $campanha->setCampanhaNome(null);
        $this->tester->assertFalse($campanha->validate('campanhaNome'));
        $campanha->setCampanhaNome('ABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZABCDEFGHIJLMNOPQRSTUVXZ');
        $this->tester->assertFalse($campanha->validate('campanhaNome'));
        $campanha->setCampanhaNome('Bom dia');
        $this->tester->assertTrue($campanha->validate('campanhaNome'));

      

    }

    function testSaveCampanha()
    {
        $campanha = new Campanha();
        $campanha->setCampanhaNome('Campanha Natal 2019');
        $campanha->setCampanhaDataInicio('2019-12-24');
        $campanha->setCampanhaDataFim('2019-12-28');
        $campanha->setCampanhaDescricao('Campanha Natal 2019');
        $campanha->save();
        $this->assertEquals('Campanha Natal 2019', $campanha->getCampanhaNome());


    }


    function testViewSavedCampanha()
    {
        $this->tester->seeInDatabase('Campanha',['campanhaNome' => 'Campanha Natal 2019', 'campanhaDataInicio' => '2019-12-24', 'campanhaDataFim' => '2019-12-28', 'campanhaDescricao' => 'Campanha Natal 2019']);
    }


    function testUpdateCampanha()
    {
        $campanhaGrab = $this->tester->grabRecord('common\models\Campanha',['campanhaNome' => 'Campanha Natal 2019', 'campanhaDescricao' => 'Campanha Natal 2019', 'campanhaDataInicio' => '2019-12-24', 'campanhaDataFim' => '2019-12-28']);

        $campanha = Campanha::findOne(['idCampanha' => $campanhaGrab->idCampanha]);
        $campanha -> campanhaNome= "Campanha Natal 2020";
        $campanha -> campanhaDescricao = "Campanha Natal 2020";
        $this->assertEquals(1, $campanha->update());
    }


    function testViewUpdatedCampanha()
    {
        $this->tester->seeInDatabase('Campanha',['campanhaNome' => 'Campanha Natal 2020', 'campanhaDataInicio' => '2019-12-24', 'campanhaDataFim' => '2019-12-28', 'campanhaDescricao' => 'Campanha Natal 2020']);
    }

    function testDeleteCampanha()
    {
        $campanhaGrab = $this->tester->grabRecord('common\models\Campanha',['campanhaNome'=>'Campanha Natal 2020', 'campanhaDataInicio' => '2019-12-24', 'campanhaDataFim' => '2019-12-28', 'campanhaDescricao' => 'Campanha Natal 2020']);
        $campanha = Campanha::findOne(['idCampanha' => $campanhaGrab->idCampanha]);
        $this->assertEquals(1, $campanha->delete());
    }

    function testNotSeeCampanha()
    {
        $this->tester->dontSeeRecord('common\models\Campanha',['campanhaNome'=>'Campanha Natal 2020']);
    }
}