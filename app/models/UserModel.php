<?php 

namespace app\models;



class UserModel extends BaseModel {
    
    public static function getField(string $pkName, string $pkValue, array $requestedFields): array{
         
        $queryString = "SELECT ";
                
        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
   
        }
        
        $queryString = rtrim($queryString,",") . " FROM workers WHERE $pkName = :value";
    
    
        $query = self::getSecureQuery($queryString, [":value"=> $pkValue]);
        $query->execute();

        $registers = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($registers) {
            return $registers[0];
        } else {
            throw new \Exception("Registro não encontrado");
        }

    }

    public static function updateUser(){

    }

    public static function updatePassword(){

    }
    
    public static function updateSector(){}

    public static function deleteUser(){

    }


    public static function setAdminPermission(){

    }


    public static function setSuperAdminPermission(){

    }

    public static function setRatingPermission(){

    }

    public static function registerUser(string $name, string $username, string $password, string $sector):bool{

        $hash = password_hash($password, PASSWORD_DEFAULT);


        $idSector = self::getField("sector_name", $sector, ["id_sector"])[0]["id_sector"];


        $query = self::getSecureQuery("INSERT INTO workers(name, user, password, id_sector) VALUES (:name, :user, :password, :id_sector)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_sector" => $idSector]);
    
        $status = $query->execute();

        return $status; 
    }

    public static function getHash(string $username):array {
        $query = self::getSecureQuery("SELECT password FROM workers WHERE user = :user", [":user" => $username]);
        
        $query->execute();

        $hash = $query->fetchAll(\PDO::FETCH_ASSOC);


        return $hash;
    }


    public static function getUser(string $username):array {
        $query = self::getSecureQuery("SELECT user FROM workers WHERE user = :user", [":user" => $username]);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}