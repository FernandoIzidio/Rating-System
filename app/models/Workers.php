<?php 

namespace app\models;


require_once "../app/models/BaseModel.php";
class ModelUser extends BaseModel {


    public function getName(string $user):string{
        $name = $this->getFields("workers", ["name"], "user", $user);
        return $name["name"];
    }

    public function editName(string $user, string $newName) {
         $query = $this->getSecureQuery("UPDATE workers SET name = :name WHERE user = :user", [":name"=> $newName, ":user" => $user] );

         try {
            $status =$query->execute();
         } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
         }
         return $status;

    }

    public function updateUser(string $oldUser, string $newUser) {
        $query = $this->getSecureQuery("UPDATE workers SET user = :newUser WHERE user = :user", [":user" => $oldUser,":newUser"=> $newUser] );

        try {
           $status = $query->execute();
        } catch (\Exception $e) {
           throw new \Exception($e->getMessage());
        }
        return $status;
    }

    public function getSector(string $user){
        $query = $this->getSecureQuery("SELECT wk.sector FROM workers as wk INNER JOIN sectors as sc ON sc.id_sector = wk.id_sector WHERE user = :user", [":user"=> $user] );

        try {
            $query->execute();
        }   catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0]["sector_name"];
    }

    public function editSector(string $user, string $newSector):bool{
        $query = $this->getSecureQuery("UPDATE (SELECT wk.id_sector FROM workers as wk INNER JOIN sectors as sc ON sc.id_sector = wk.id_sector) SET sector_name = :sector WHERE user = :user", [":user" => $user, ":sector" => $newSector]);

        try {
            $status =  $query->execute();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $status;
    }
 
    public function updateSector($user, $newSector){
        $query = $this->getSecureQuery("", []);
    }
    public function getHash($user):string {
        try {
        $hash = $this->getFields("workers", ["password"], "user", $user)["password"];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $hash;
    }
    



    public function loginUser(string $username, $password):bool {
        $query = $this->getSecureQuery("SELECT password FROM workers WHERE user = :user", [":user" => $username]);
        
        $query->execute();

        $hash = $query->fetchAll(\PDO::FETCH_ASSOC)[0];


        return  password_verify($password, $hash["password"]);
    }

    public function hasPermission(string $idName, $idValue, string $permissionName):bool {
        try {
            $permission = $this->getField("workers", [$permissionName], $idName, $idValue)[$permissionName];
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
            return $permission;
    }

    

    public function hasUser(string $username):bool {
        $query = $this->getSecureQuery("SELECT user FROM workers WHERE user = :user", [":user" => $username]);
        try {
            $query->execute();
            $user = $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return count($user) > 0;
    }

}