<?php 

namespace app\models;



class UserModel extends BaseModel {
    
    public function getField(string $pkName, string $pkValue, array $requestedFields): array{
         
        $queryString = "SELECT ";
                
        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
   
        }
        
        $queryString = rtrim($queryString,",") . " FROM workers WHERE $pkName = :value";
    
    
        $query = $this->getSecureQuery($queryString, [":value"=> $pkValue]);
        $query->execute();

        $registers = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($registers) {
            return $registers[0];
        } else {
            throw new \Exception("Registro não encontrado");
        }

    }

    public function updateUser(){

    }

    public function updatePassword(){

    }
    
    public function updateSector(){}

    public function deleteUser(){

    }


    public function setAdminPermission(){

    }


    public function setSuperAdminPermission(){

    }

    public function registerUser(string $name, string $username, string $password, string $sector):bool{

        $hash = password_hash($password, PASSWORD_DEFAULT);


        $idSector = $this->getField("sector_name", $sector, ["id_sector"])[0]["id_sector"];


        $query = $this->getSecureQuery("INSERT INTO workers(name, user, password, id_sector) VALUES (:name, :user, :password, :id_sector)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_sector" => $idSector]);
    
        $status = $query->execute();

        return $status; 
    }

    public function getHash(string $username):array {
        $query = $this->getSecureQuery("SELECT password FROM workers WHERE user = :user", [":user" => $username]);
        
        $query->execute();

        $hash = $query->fetchAll(\PDO::FETCH_ASSOC);


        return $hash;
    }


    public function getUser(string $username):array {
        $query = $this->getSecureQuery("SELECT user FROM workers WHERE user = :user", [":user" => $username]);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}