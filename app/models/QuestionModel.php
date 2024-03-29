<?php 

namespace app\models;

class QuestionModel extends BaseModel{
    public static function getField(string $pkName, string $pkValue, array $requestedFields): array{
        $queryString = "SELECT ";

        foreach ($requestedFields as $field) { 
            $queryString .= $field . ",";
        }
        $queryString.= rtrim($queryString, ",") . " FROM questions WHERE $pkName = :id";

        $query = self::getSecureQuery($queryString, [":id" => $pkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getQuestion($likePkName, $likePkValue): array{
        $queryString = "SELECT question_text  FROM questions WHERE $likePkName = :id";

        $query = self::getSecureQuery($queryString, [":id" => $likePkValue]);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createQuestion(string $text): bool{
        $queryString = "INSERT INTO questions(question_text) VALUES (:text)";

        $query = self::getSecureQuery($queryString, [":text" => $text]);
        $status = $query->execute();

        return $status;
    }

    public static function deleteQuestion(string $idQuestion): bool{
        $queryString = "DELETE FROM questions WHERE id_question = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idQuestion]);
        $status = $query->execute();

        return $status;
    }

    public static function updateQuestion(string $idQuestion, string $text): bool{
        $queryString = "UPDATE questions SET question_text = :text WHERE id_question = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idQuestion, ":text" => $text]);
        $status = $query->execute();

        return $status;
    }
    

    public static function deleteAllQuestionFromSector(string $idSector): bool{
        $queryString = "DELETE FROM questions WHERE id_sector = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idSector]);
        $status = $query->execute();

        return $status;
    }


    public static function deleteAllQuestionFromAssessment(string $idAssessment): bool{
        $queryString = "DELETE FROM questions WHERE id_assessment = :id";

        $query = self::getSecureQuery($queryString, [":id" => $idAssessment]);
        $status = $query->execute();

        return $status;
    }

    
}