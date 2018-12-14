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

        /*$user = new Pessoa();
        $user->setNome('Pieter Aparicio');
        $user->setIdade(21);
        $user->setMorada('Avenida General Humberto Delgado Leiria');
        $user->setNIF(254157845);
        $user->setEmail('pieter.aparicio@hotmail.com');
        $user->save();

        $this->assertEquals('Pieter Aparicio', $user->getNome());*/
    }

    function testViewSavedCampanha()
    {
        $this->tester->seeInDatabase('Campanha',['campanhaNome' => 'Campanha Natal 2018', 'campanhaDataInicio' => '2018-12-24', 'campanhaDataFim' => '2018-12-28', 'campanhaDescricao' => 'Campanha Natal 2018']);
        //$this->tester->seeInDatabase('pessoa', ['nome' => 'Pieter Aparicio', 'morada' => 'Avenida General Humberto Delgado Leiria']);
    }

    function testUpdateSavedCampanha()
    {
        $id = $this->tester->grabRecord('common\models\Campanha',['campanhaNome' => 'Campanha Natal 2018']);

        $campanha = Campanha::findOne($id);
        $campanha->campanhaDataInicio = "2018-12-15";
        $campanha->update();
        /*
        $id = $this->tester->grabRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
        $pessoa = Pessoa::findOne($id);
        $pessoa -> idade = 18;
        $pessoa->update();*/
    }

    function testViewUpdateSavedCampanha()
    {
        $this->tester->seeRecord('common\models\Campanha',['campanhaNome'=>'Campanha Natal 2018']);
        //$this->tester->seeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }

    //f. Apagar o registo
    function testDeleteUpdatedSavedCampanha()
    {
        $id = $this->tester->grabRecord('common\models\Campanha',['campanhaNome' => 'Campanha Natal 2018']);

        $campanha = Campanha::findOne($id);
        $campanha->delete();
        /*$id = $this->tester->grabRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
        $pessoa = Pessoa::findOne($id);
        $pessoa->delete();*/
    }

    //g. Verificar que o registo não se encontra na BD.
    function testViewDeletedUpdatedSavedCampanha()
    {
        $this->tester->dontSeeRecord('common\models\Campanha',['campanhaNome'=>'Campanha Natal 2018']);
        //$this->tester->dontSeeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
}