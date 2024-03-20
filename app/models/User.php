<?php 

namespace app\models;
require_once __DIR__ ."/ParentModel.php";
class ModelUser extends BaseModel {
    
    public function getField($table, array $fieldTarget, $fieldFilter, $filterValue): array{
         
        $queryString = "SELECT ";
                
        foreach ($fieldTarget as $field) { 
            $queryString .= $field . ",";
   
        }
        
        $queryString = rtrim($queryString,",") . " FROM $table WHERE $fieldFilter = :value";
    
    
        $query = $this->getSecureQuery($queryString, [":value"=> $filterValue]);
        $query->execute();

        $registers = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($registers) {
            return $registers[0];
        } else {
            throw new \Exception("Registro não encontrado");
        }

    }


    
    public function registerUser(string $name, string $username, string $password, string $sector):bool{

        $hash = password_hash($password, PASSWORD_DEFAULT);


        $idSector = $this->getField("sectors", ["id_sector"],  "sector_name", $sector)["id_sector"];


        $query = $this->getSecureQuery("INSERT INTO workers(name, user, password, id_sector) VALUES (:name, :user, :password, :id_sector)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_sector" => $idSector]);
    
        $status = $query->execute();

        return $status; 
    }

    public function loginUser(string $username, $password):bool {
        $query = $this->getSecureQuery("SELECT password FROM workers WHERE user = :user", [":user" => $username]);
        
        $query->execute();

        $hash = $query->fetchAll(\PDO::FETCH_ASSOC)[0];


        return  password_verify($password, $hash["password"]);
    }


    public function getUser(string $username):array {
        $query = $this->getSecureQuery("SELECT user FROM workers WHERE user = :user", [":user" => $username]);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}