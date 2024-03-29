<?php

namespace app\models;


class AssessmentModel extends BaseModel{
    public static function getField(string $pkName, string $pkValue, array $requestedFields): array{
        $queryString = "SELECT ";

        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
        }
        $queryString.= rtrim($queryString, ",") . " FROM assessments WHERE $pkName = :id";

        $query = self::getSecureQuery($queryString, [":id" => $pkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getAssessment($likePkName, $likePkValue): array{
        $queryString = "SELECT assessment_name  FROM assessments WHERE $likePkName = :id";

        $query = self::getSecureQuery($queryString, [":id" => $likePkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createAssessment(string $name): bool{
        $queryString = "INSERT INTO assessments(assessment_name) VALUES (:name)";

        $query = self::getSecureQuery($queryString, [":name" => $name]);
        $status = $query->execute();

        return $status;
    }



    public static function deleteAssessment(string $idAssessment): bool{
        QuestionModel::deleteAllQuestionFromAssessment($idAssessment);

        $queryString = "DELETE FROM assessments WHERE id_assessment = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idAssessment]);
        $status = $query->execute();

        return $status;
    }

    public static function updateAssessment(string $idAssessment, string $name): bool{
        $queryString = "UPDATE assessments SET assessment_name = :name WHERE id_assessment = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idAssessment, ":name" => $name]);
        $status = $query->execute();

        return $status;
    }



    public static function deleteAllAssessmentFromSector(string $idSector): bool{

        QuestionModel::deleteAllQuestionFromSector($idSector);

        $queryString = "DELETE FROM assessments WHERE id_sector = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idSector]);
        $status = $query->execute();

        return $status;
    }

}
