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
        $this->tester->assertFalse($user->validate('username'));
        $user->setUsername(null);
        $this->tester->assertFalse($user->validate('username'));
        $user->setUsername('undbsauydsabuydgsaundbsauydsabuydgsauydfpuisafisafgpuisagfuiposagfuisagfpuisagfpuiasgfpuisagfpuiasgfpuisagfpuisagfuguuydfpuisafisafgpuisagfuiposagfuisagfpuisagfpuiasgfpuisagfpuiasgfpuisagfpuisagfugu+isafgpuisagfuiposagfuisagfpuisagfpuiasgfpuisagfpuiasgfpuisagfpuisagfu+isagfuisagfuisagfpuiasgfu+isagbfugfuiagfpuisagfu+isagfu8sagfgfhgfpuisa');
        $this->tester->assertFalse($user->validate('username'));
        $user->setUsername('test12321');
        $this->tester->assertTrue($user->validate('username'));

        $user->setEmail('ok@c');
        $this->tester->assertFalse($user->validate('email'));
        $user->setEmail(null);
        $this->tester->assertFalse($user->validate('email'));
        $user->setEmail('ok@uhfuhidguhigdgsuhigwuhiefguhiguhihdfhdfhdgjoijoijoijoijoijokjokdfpkmfgdigmnfidgnoidfngoidfngoidfngoidfngoingniodfngodfngiodfngoidfngidfngdfogndfgdfgdfgdfgdfgdf.com');
        $this->tester->assertFalse($user->validate('email'));
        $user->setEmail('test2019@gmail.com');
        $this->tester->assertTrue($user->validate('email'));

    }
    public function testFieldSizeUserData()
    {
        $userdata = new Userdata();

        $userdata->setUserApelido('d');
        $this->tester->assertFalse($userdata->validate('userApelido'));
        $userdata->setUserApelido(null);
        $this->tester->assertFalse($userdata->validate('userApelido'));
        $userdata->setUserApelido('uhfuhidguhigdgsuhigwuhiefguhiguhihdfhdfhdgjoijoijoijoijoijokjokdfpkmfgdigmnfidgnoidfngoidfngoidfngoidfngoingniodfngodfngiodfngoidfngidfngdfogndfgdfgdfgdfgdfgdf');
        $this->tester->assertFalse($userdata->validate('userApelido'));
        $userdata->setUserApelido('Dia');
        $this->tester->assertTrue($userdata->validate('userApelido'));

        $userdata->setUserNomeProprio('d');
        $this->tester->assertFalse($userdata->validate('userNomeProprio'));
        $userdata->setUserNomeProprio(null);
        $this->tester->assertFalse($userdata->validate('userNomeProprio'));
        $userdata->setUserNomeProprio('uhfuhidguhigdgsuhigwuhiefguhiguhihdfhdfhdgjoijoijoijoijoijokjokdfpkmfgdigmnfidgnoidfngoidfngoidfngoidfngoingniodfngodfngiodfngoidfngidfngdfogndfgdfgdfgdfgdfgdf');
        $this->tester->assertFalse($userdata->validate('userNomeProprio'));
        $userdata->setUserNomeProprio('Bom');
        $this->tester->assertTrue($userdata->validate('userNomeProprio'));

        $userdata->setUserMorada('dsas');
        $this->tester->assertFalse($userdata->validate('userMorada'));
        $userdata->setUserMorada(null);
        $this->tester->assertFalse($userdata->validate('userMorada'));
        $userdata->setUserMorada('dsadasdsadadsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadassdsadasdsadasdsadasdsadasdsadasdsadas');
        $this->tester->assertFalse($userdata->validate('userMorada'));
        $userdata->setUserMorada('Rua das Moradas N123');
        $this->tester->assertTrue($userdata->validate('userMorada'));

        $userdata->setUserNIF('123');
        $this->tester->assertFalse($userdata->validate('userNIF'));
        $userdata->setUserNIF(null);
        $this->tester->assertFalse($userdata->validate('userNIF'));
        $userdata->setUserNIF(983217798321);
        $this->tester->assertFalse($userdata->validate('userNIF'));
        $userdata->setUserNIF('983217798321');
        $this->tester->assertFalse($userdata->validate('userNIF'));
        $userdata->setUserNIF('123');
        $this->tester->assertFalse($userdata->validate('userNIF'));
        $userdata->setUserNIF('123321222');
        $this->tester->assertTrue($userdata->validate('userNIF'));
        $userdata->setUserNIF(123321222);
        $this->tester->assertTrue($userdata->validate('userNIF'));
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
        $userdata->setUserDataNasc('2000-02-08');
        $userdata->setUserEstado('user');
        $userdata->setUserNIF(122123129);
        $userdata->setUserId($user->id);
        $userdata->save(false);
        $this->assertEquals(122123129, $userdata->getUserNIF());

    }
    function testViewSavedUser()
    {
        $this->tester->seeInDatabase('user',['username' => 'pedromig1112']);
        //$this->tester->seeInDatabase('pessoa', ['nome' => 'Pieter Aparicio', 'morada' => 'Avenida General Humberto Delgado Leiria']);
    }
    function testViewSavedUserData()
    {
        $this->tester->seeInDatabase('userdata',['userNIF' => '122123129']);
        //$this->tester->seeInDatabase('pessoa', ['nome' => 'Pieter Aparicio', 'morada' => 'Avenida General Humberto Delgado Leiria']);
    }
    function testUpdateSavedUser()
    {
        $id = $this->tester->grabRecord('common\models\User',['username' => 'pedromig1112']);
        $user = User::findOne(['id'=>$id->id]);
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
        $idData = $this->tester->grabRecord('common\models\Userdata',['userNIF' => '122123129']);
        $userData = Userdata::findOne(['iduser'=>$idData->iduser]);
        $userData->userMorada = "Rua Rainha Santa Isabel";
        $userData->update(false);
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
    function testDeletedSavedUserData()
    {
        $idData = $this->tester->grabRecord('common\models\Userdata',['userNIF' => '122123129']);
        $userdata = Userdata::findOne(['iduser'=>$idData->iduser]);
        $userdata->delete();

    }
    function testViewDeletedSavedUserData()
    {
        $this->tester->dontSeeRecord('common\models\Userdata',['userNIF'=>'122123129']);
        //$this->tester->dontSeeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
    //f. Apagar o registo
    function testDeletedSavedUser()
    {
        $idData = $this->tester->grabRecord('common\models\User',['username' => 'pedromig']);
        $user = User::findOne(['iduser'=>$idData->iduser]);
        $user->delete();
    }

    function testViewDeletedSavedUser()
    {
    $this->tester->dontSeeRecord('common\models\User',['username'=>'pedromig1112']);
    //$this->tester->dontSeeRecord('common\models\Pessoa',['nome'=>'Pieter Aparicio']);
    }
}