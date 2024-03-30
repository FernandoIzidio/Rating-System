<?php 


namespace app\tests;

use app\models\SectorModel;
use PHPUnit\Framework\TestCase;
use app\models\UserModel;



class UserModelTest extends TestCase
{
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



}

