<?php
namespace app\models;
use app\database\config\Connection;

class AssessmentAnswersModel extends BaseModel{
    public static function getField(string $pkName, string $pkValue, array $requestedFields): array{
        $queryString = "SELECT ";

        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
        }
        $queryString.= rtrim($queryString, ",") . " FROM assessment_answers WHERE $pkName = :id";

        $query = self::getSecureQuery($queryString, [":id" => $pkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getAll($idSector): array{
        $queryString = "SELECT id_worker, id_assessment FROM assessment_answers WHERE id_sector = :id";

        $query = Connection::getConnection()->prepare($queryString);
        $query->bindValue(":id", $idSector);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createAssessmentAnswer(string $idWorker, string $idAssessment, $idSector): bool{
        $queryString = "INSERT INTO assessment_answers(id_worker, id_assessment, id_sector) VALUES (:idWorker, :idAssessment, :idSector)";

        $query = Connection::getConnection()->prepare($queryString);
        $query->bindValue(":idWorker", $idWorker);
        $query->bindValue(":idAssessment", $idAssessment);
        $query->bindValue(":idSector", $idSector);
        $status = $query->execute();

        return $status;
    }

    public static function deleteAssessmentAnswer(string $idAnswer): bool{
        $queryString = "DELETE FROM assessment_answers WHERE id_answer = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idAnswer]);
        $status = $query->execute();

        return $status;
    }
}