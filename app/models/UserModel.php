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

        return $registers;
    }

    public static function updateUser(string $email, string $newUser){
        $queryString = "UPDATE workers SET user = :user WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":user"=> $newUser]);
        $query->execute();
    }

    public static function updatePassword(string $email, string $newPassword){
        $queryString = "UPDATE workers SET password = :password WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":password"=> $newPassword]);
        $query->execute();
    }
    
    public static function updateSector(string $email, string $newSector){
        $idSector = SectorModel::getField("sector_name", $newSector, ["id_sector"])[0]["id_sector"];

        $queryString = "UPDATE workers SET id_sector = :sector WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":sector"=> $idSector]);
        $query->execute();
    }

    public static function deleteUser($email){
        $queryString = "DELETE FROM workers WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email]);
        $query->execute();
    }


    public static function setAdminPermission(string $email, bool $isActive){
        $isActive = $isActive ?1:0;

        $queryString = "UPDATE workers SET admin_permission = :status WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":status"=> $isActive]);
        $query->execute();
    }


    public static function setSuperAdminPermission($email, bool $isActive){
        $isActive = $isActive ?1:0;

        $queryString = "UPDATE workers SET super_admin = :status WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":status"=> $isActive]);
        $query->execute();
    }

    public static function setRatingPermission(string $email, bool $isActive){
        $isActive = $isActive ?1:0;

        $queryString = "UPDATE workers SET rating_permission = :status WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":status"=> $isActive]);
        $query->execute();
    }

    public static function registerUser(string $name, string $username, string $email, string $password, string $sector):bool{

        $hash = password_hash($password, PASSWORD_DEFAULT);


        $idSector = SectorModel::getField("sector_name", $sector, ["id_sector"])[0]["id_sector"];


        $query = self::getSecureQuery("INSERT INTO workers(name, user, email, password, id_sector) VALUES (:name, :user, :email, :password, :id_sector)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_sector" => $idSector, ":email" => $email]);
    
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