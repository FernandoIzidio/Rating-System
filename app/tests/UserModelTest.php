<?php 


namespace app\tests;
use PHPUnit\Framework\TestCase;
use app\models\UserModel;

class UserModelTest extends TestCase
{
    public function testRegisterUser()
    {
        $userModel = new UserModel();
        $name = 'John Doe';
        $username = 'johndoe';
        $email = 'johndoe@example.com';
        $password = 'password123';
        $sector = 'Tecnologia';

    
        $status = $userModel->registerUser($name, $username, $email, $password, $sector);

        
        $this->assertTrue($status);
    }
}