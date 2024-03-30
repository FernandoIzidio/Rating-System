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

    public static function updateUser(string $email, string $newUser):bool{
        $queryString = "UPDATE workers SET user = :user WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":user"=> $newUser]);
        $status = $query->execute();
        return $status;
    }

    public static function updatePassword(string $email, string $newPassword):bool{
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);

        $queryString = "UPDATE workers SET password = :password WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":password"=> $hash]);
        $status = $query->execute();
        return $status;
    }
    
    public static function updateSector(string $email, string $newSectorName):bool{
        $idSector = SectorModel::getField("sector_name", $newSectorName, ["id_sector"])[0]["id_sector"];

        $queryString = "UPDATE workers SET id_sector = :sector WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":sector"=> $idSector]);
        $status = $query->execute();
        return $status;
    }

    public static function deleteUser(string $email): bool{
        $queryString = "DELETE FROM workers WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email]);
        $status = $query->execute();
        return $status;
    }


    public static function setAdminPermission(string $email, bool $isActive):bool{
        $isActive = $isActive ?1:0;

        $queryString = "UPDATE workers SET admin_permission = :status WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":status"=> $isActive]);
        $status = $query->execute();
        return $status;
    }


    public static function setSuperAdminPermission(string $email, bool $isActive):bool{
        $isActive = $isActive ?1:0;

        $queryString = "UPDATE workers SET super_admin = :status WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":status"=> $isActive]);
        $status = $query->execute();
        return $status;
    }

    public static function setRatingPermission(string $email, bool $isActive):bool{
        $isActive = $isActive ?1:0;

        $queryString = "UPDATE workers SET rating_permission = :status WHERE email = :email";
        $query = self::getSecureQuery($queryString, [":email" => $email, ":status"=> $isActive]);
        $status = $query->execute();
        return $status;
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


    public static function getUser(string $email):array {
        $query = self::getSecureQuery("SELECT user FROM workers WHERE email = :email", [":email" => $email]);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function getSectorName(string $email):array {
        $query = self::getSecureQuery("SELECT sector_name FROM workers INNER JOIN sectors ON workers.id_sector = sectors.id_sector WHERE email = :email", [":email" => $email]);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}