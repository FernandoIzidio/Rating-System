<?php 

namespace app\models;
require_once __DIR__ ."/ParentModel.php";
class ModelUser extends BaseModel {
    
    private function getIdSector($sector){
        $query = $this->getSecureQuery("SELECT id_sector FROM sectors WHERE sector_name = :sector", [":sector"=> $sector]);
        $query->execute();

        $sectors = $query->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($sectors as $sector){
            return $sector["id_sector"];
        }        
    }
    
    public function registerUser(string $name, string $username, string $password, string $sector):bool{
        $user = $this->getUser($username);
        
        if (count($user) > 0) return false;

        $idSector = $this->getIdSector($sector);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->getSecureQuery("INSERT INTO workers(name, user, password, id_sector) VALUES (:name, :user, :password, :id_sector)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_sector" => $idSector]);
    
        $status = $query->execute();

        return $status; 
    }

    public function loginUser(string $username, $password):bool {
        
        $query = $this->getSecureQuery("SELECT password FROM workers WHERE user = :user", [":user", $username]);

        $query->execute();

        $hash = $query->fetchAll(\PDO::FETCH_ASSOC)["password"];
        
        return password_verify($password, $hash);
    }


    public function getUser(string $username):array {
        $query = $this->getSecureQuery("SELECT user FROM workers WHERE user = :user", [":user" => $username]);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}