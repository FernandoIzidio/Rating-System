<?php 
namespace app\models;
use app\database\config\Connection;

class SectorModel extends BaseModel{
    public static function getField(string $pkName, string $pkValue, array $requestedFields): array{
        $queryString = "SELECT ";

        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
        }
        $queryString.= rtrim($queryString, ",") . " FROM sectors WHERE id = :id";

        $query = self::getSecureQuery($queryString, [":id" => $pkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }



    public static function getAll(): array{
        $queryString = "SELECT * FROM sectors";

        $query = Connection::getConnection()->prepare($queryString);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createSector(string $name): bool{
        $queryString = "INSERT INTO sectors(name) VALUES (:name)";

        $query = Connection::getConnection()->prepare($queryString);
        $query->bindValue(":name", $name);
        $status = $query->execute();
  
        return $status;
    }

    public static function deleteSector(string $likeIdName, string $likeIdValue): bool{
        $queryString = "DELETE FROM sectors WHERE $likeIdName = :id";

        $query = Connection::getConnection()->prepare($queryString);
        $query->bindValue(":id", $likeIdValue);
        $status = $query->execute();
        return $status;
    }

    public static function updateSector(string $likeIdName, string $likeIdValue, string $newName): bool{
        $queryString = "UPDATE sectors SET name = :name WHERE $likeIdName = :id";

        $query = Connection::getConnection()->prepare($queryString);
        $query->bindValue(":id", $likeIdValue);
        $query->bindValue(":name", $newName);
        $status = $query->execute();
        return $status;
    }
}