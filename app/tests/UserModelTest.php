<?php 


namespace app\tests;

use app\models\SectorModel;
use PHPUnit\Framework\TestCase;
use app\models\UserModel;



class UserModelTest extends TestCase
{
    CONST EMAIL = 'johndoe@example.com';
    public function testRegisterUser()
    {   
        $fk = \Faker\Factory::create("pt_BR");

    

        $userModel = new UserModel();

        $name = $fk->name();
        $username = $fk->userName();
        $email = $fk->email();
        $password = $fk->password();
    
        
        $sectors = array_column(SectorModel::getAll(), "sector_name");

        $sector = $sectors[array_rand($sectors)];

        $status = $userModel->registerUser($name, $username, $email, $password, $sector);

        
        $this->assertTrue($status);
    }

    public function testGetField()
    {   
        $pkName = 'email';
        $pkValue = UserModelTest::EMAIL;
        $requestedFields = ['name', 'user'];

        $user = UserModel::getField($pkName, $pkValue, ["name", "user"])[0];

        $expectedResult = [[
            'name' => $user["name"],
            'user' => $user["user"],
        ]];
        
        

        
        
        $result = UserModel::getField($pkName, $pkValue, $requestedFields);

        
        $this->assertEquals($expectedResult, $result);
    }

    public function testUpdateUser()
    {
        
        $email = UserModelTest::EMAIL;
        $newUser = 'johndoeTest';
        
       
        $status = UserModel::updateUser($email, $newUser);


        $this->assertTrue($status);

        
        $updatedUser = UserModel::getField('email', $email, ['user']);
        $this->assertEquals($newUser, $updatedUser[0]['user']);
        
    
    }

    public function testUpdatePassword()
    {
        
        $email = UserModelTest::EMAIL;
        $newPassword = 'new_password';
        

        
        $status = UserModel::updatePassword($email, $newPassword);

        
        $this->assertTrue($status);

        $hash = UserModel::getField("email", $email, ["password"])[0]["password"];

        $this->assertTrue(password_verify($newPassword, $hash));
    }



    public function testUpdateSector()
    {
        $email = UserModelTest::EMAIL;
        $sectors = SectorModel::getAll();
        $newSector = $sectors[array_rand($sectors)];
        
        $status = UserModel::updateSector($email, $newSector["sector_name"]);

        
        $this->assertTrue($status);

        $sector = UserModel::getField("email", $email, ["id_sector"])[0]["id_sector"];

        $this->assertEquals($newSector["id_sector"], $sector);

    }

    public function testSetRatingPermission()
    {
        $email = UserModelTest::EMAIL;
        $oldStatus = UserModel::getField("email", $email, ["super_admin"])[0]["super_admin"];

        $newStatus = !$oldStatus;
    
        
        $status = UserModel::setRatingPermission($email, $newStatus);

        
        $this->assertTrue($status);

        $currentStatus = UserModel::getField("email", $email, ["rating_permission"])[0]["rating_permission"];

        $this->assertEquals($newStatus, $currentStatus);
    }


    public function testSetAdminPermission()
    {

        $email = UserModelTest::EMAIL;
        
        $oldStatus = UserModel::getField("email", $email, ["admin_permission"])[0]["admin_permission"];

        $newStatus = !$oldStatus;

        $status = UserModel::setAdminPermission($email, $newStatus);


        $this->assertTrue($status);


        $result = UserModel::getField("email", $email, ["admin_permission"])[0]["admin_permission"];

        $this->assertEquals($newStatus, $result);
    }


    public function testSetSuperAdminPermission()
    {
        
        $email = UserModelTest::EMAIL;
        
        $oldStatus = UserModel::getField("email", $email, ["super_admin"])[0]["super_admin"];

        $newStatus = !$oldStatus; 

        

       
        $status = UserModel::setSuperAdminPermission($email, $newStatus);

       
        $this->assertTrue($status);

        
        $result = UserModel::getField("email", $email, ["super_admin"])[0]["super_admin"];

        $this->assertEquals($newStatus, $result);
    }
  

    public function testDeleteUser()
    {   

        $status = UserModel::registerUser("test", "test123", "test@email.com", "test", "Tecnologia");

        $this->assertTrue($status);

        $email = "test@email.com";
        
        $status = UserModel::deleteUser($email);

        
        $this->assertTrue($status);
    }

    public function testGetHash()
    {
        
        $status = UserModel::registerUser("Tester Silva", "test123", "test@email.com", "test", "Tecnologia");

        $this->assertTrue($status);
        
        $username = 'test123';
        
        $result = UserModel::getHash($username);
        
        $this->assertTrue(password_verify("test", $result[0]['password']));
        
        
        $status = UserModel::deleteUser("test@email.com");

        $this->assertTrue($status);
    }

    public function testGetUser()
    {
        
        $validUsername = [['user' =>'johndoeTest']];

    
        $validUser = UserModel::getUser(UserModelTest::EMAIL);
      
        $this->assertEquals($validUsername, $validUser);
    }

    public function testGetSectorName()
    {
        $status = UserModel::registerUser("Tester Silva", "test123", "test@email.com", "test", "Tecnologia");

        $this->assertTrue($status);
        
        $expectSector = [["sector_name" => "Tecnologia"]];
        
        $result = UserModel::getSectorName("test@email.com");
        
        $this->assertEquals($expectSector, $result);
        
        
        $status =UserModel::deleteUser("test@email.com");
    
        $this->assertTrue($status);
    }

}


