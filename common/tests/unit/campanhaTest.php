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
    public function testFieldSize()
    {
        $campanha = new Campanha();
        $campanha->setCampanhaNome(null);
        $campanha->setCampanhaDataInicio('2019-12-01');
        $campanha->setCampanhaDataFim('2018-12-28');
        $campanha->setCampanhaDescricao('Campanha Natal 2018');
        $this->tester->assertFalse($campanha->save());
    }

    function testSaveCampanha()
    {
        $campanha = new Campanha();
        $campanha->setCampanhaNome('Campanha Natal 2018');
        $campanha->setCampanhaDataInicio('2018-12-24');
        $campanha->setCampanhaDataFim('2018-12-28');
        $campanha->setCampanhaDescricao('Campanha Natal 2018');
        $campanha->save();
        $this->assertEquals('Campanha Natal 2018', $campanha->getCampanhaNome());
    }

    function testViewSavedCampanha()
    {
        $this->tester->seeInDatabase('Campanha',['campanhaNome' => 'Campanha Natal 2018', 'campanhaDataInicio' => '2018-12-24', 'campanhaDataFim' => '2018-12-28', 'campanhaDescricao' => 'Campanha Natal 2018']);
    }

    function testUpdateSavedCampanha()
    {
        $id = $this->tester->grabRecord('common\models\Campanha',['campanhaNome' => 'Campanha Natal 2018']);

        $campanha = Campanha::findOne($id);
        $campanha->campanhaDataInicio = "2018-12-15";
        $campanha->update();
    }

    function testViewUpdateSavedCampanha()
    {
        $this->tester->seeRecord('common\models\Campanha',['campanhaNome'=>'Campanha Natal 2018']);
    }

    //f. Apagar o registo
    function testDeleteUpdatedSavedCampanha()
    {
        $id = $this->tester->grabRecord('common\models\Campanha',['campanhaNome' => 'Campanha Natal 2018']);

        $campanha = Campanha::findOne($id);
        $campanha->delete();
    }

    //g. Verificar que o registo n�o se encontra na BD.
    function testViewDeletedUpdatedSavedCampanha()
    {
        $this->tester->dontSeeRecord('common\models\Campanha',['campanhaNome'=>'Campanha Natal 2018']);
    }
}