<?php namespace common\tests;

use common\models\User;
use common\models\Userdata;

class userdataTest extends \Codeception\Test\Unit
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
    public function testFieldSizeUser()
    {
        $user = new User();
        $user->setUsername('D');
        $user->setEmail('ok@gmaidasasasasasasasasasasasasasasasasasl.com');
        $user->setPassword('d');
        $user->generateAuthKey();
        $this->tester->assertFalse($user->save());
    }
    public function testFieldSizeUserData()
    {
        $userdata = new Userdata();
        $userdata->setUserApelido('d');
        $userdata->setUserNomeProprio('d');
        $userdata->setUserDataNasc('2018-12-28');
        $userdata->setUserEstado('user');
        $userdata->setUserMorada('dsadas');
        $userdata->setUserNIF('123');
        $this->tester->assertFalse($userdata->save());

    }

    function testSaveUser()
    {
        $user = new User();
        $user->setUsername('pedromig1112');
        $user->setEmail('olaolaola@gmail.com');
        $user->setPassword('123123');
        $user->generateAuthKey();
        $user->save();


        $this->assertEquals('pedromig1112', $user->getUsername());

    }
    function testSaveUserData()
    {
        $user = $this->tester->grabRecord('common\models\User',['username' => 'pedromig1112']);
        $userdata = new Userdata();
        $userdata->setUserApelido('Inacio');
        $userdata->setUserNomeProprio('Pedro');
        $userdata->setUserMorada('iasdnuidashudashudhas');
        $userdata->setUserDataNasc('2010-12-28');
        $userdata->setUserEstado('user');
        $userdata->setUserNIF('122123122');
        $userdata->setUserId($user->id);
        $userdata->save();
        $this->assertEquals('122123122', $userdata->getUserNIF());

    }
    function testViewSavedUser()
    {
        $this->tester->seeInDatabase('user',['username' => 'pedromig1112']);
        //$this->tester->seeInDatabase('pessoa', ['nome' => 'Pieter Aparicio', 'morada' => 'Avenida General Humberto Delgado Leiria']);
    }
    function testViewSavedUserData()
    {
        $this->tester->seeInDatabase('userdata',['userNIF' => '122123122']);
        //$this->tester->seeInDatabase('pessoa', ['nome' => 'Pieter Aparicio', 'morada' => 'Avenida General Humberto Delgado Leiria']);
    }
    function testUpdateSavedUser()
    {
        $id = $this->tester->grabRecord('common\models\User',['username' => 'pedromig1112']);
        $user = User::findOne($id);
        $user->username = "pedromig";
        $user->update();

        /*
        $id = $this->tester->grabRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
        $pessoa = Pessoa::findOne($id);
        $pessoa -> idade = 18;
        $pessoa->update();*/
    }
    function testUpdateSavedUserData()
    {
        $idData = $this->tester->grabRecord('common\models\Userdata',['userNIF' => '122123122']);
        $userData = Userdata::findOne($idData);
        $userData->userMorada = "Rua Rainha Santa Isabel";
        $userData->update();
        /*
        $id = $this->tester->grabRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
        $pessoa = Pessoa::findOne($id);
        $pessoa -> idade = 18;
        $pessoa->update();*/
    }
    function testViewUpdateSavedUser()
    {
        $this->tester->seeRecord('common\models\User',['username'=>'pedromig']);
        //$this->tester->seeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
    function testViewUpdateSavedUserData()
    {
        $this->tester->seeRecord('common\models\Userdata',['userMorada'=>'Rua Rainha Santa Isabel']);
        //$this->tester->seeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
    function testDeleteUpdatedSavedUserData()
    {
        $idData = $this->tester->grabRecord('common\models\Userdata',['userNIF' => '122123122']);
        $userdata = Userdata::findOne($idData);
        $userdata->delete();

        /*$id = $this->tester->grabRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
        $pessoa = Pessoa::findOne($id);
        $pessoa->delete();*/
    }
    //f. Apagar o registo
    function testDeleteUpdatedSavedUser()
    {
        $id = $this->tester->grabRecord('common\models\User',['username' => 'pedromig']);
        $user = User::findOne($id);
        $user->delete();


        /*$id = $this->tester->grabRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
        $pessoa = Pessoa::findOne($id);
        $pessoa->delete();*/
    }

    //g. Verificar que o registo não se encontra na BD.
    function testViewDeletedUpdatedSavedUserData()
    {
        $this->tester->dontSeeRecord('common\models\Userdata',['userNIF'=>'122123122']);
        //$this->tester->dontSeeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
    function testViewDeletedUpdatedSavedUser()
    {
    $this->tester->dontSeeRecord('common\models\User',['username'=>'pedromig']);
    //$this->tester->dontSeeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
}