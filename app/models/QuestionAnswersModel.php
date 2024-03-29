<?php 

namespace app\models;


class QuestionAnswersModel extends BaseModel{
    public static function getField(string $pkName, string $pkValue, array $requestedFields): array{
        $queryString = "SELECT ";

        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
        }
        $queryString.= rtrim($queryString, ",") . " FROM question_answers WHERE $pkName = :id";

        $query = self::getSecureQuery($queryString, [":id" => $pkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


    public static function getQuestionAnswers(string $idAssessment) : array{
        $queryString = "SELECT id_question, answer FROM question_answers WHERE id_assessment = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idAssessment]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createQuestionAnswer(string $idQuestion, string $answer, string $idAssessment): bool{
        $queryString = "INSERT INTO question_answers(id_question, answer, id_assessment) VALUES (:idQuestion, :answer, :idAssessment)";

        $query = self::getSecureQuery($queryString, [":idQuestion" => $idQuestion, ":answer" => $answer, ":idAssessment" => $idAssessment]);
        $status = $query->execute();

        return $status;
    }

    
}