<?php

namespace app\models;


abstract class BaseModel {
    protected $pdo;

    function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    protected function getSecureQuery($query, ...$params):\PDOStatement{

        $query = $this->pdo->prepare($query);
        
        if (!empty($params)){
        foreach($params as $dict){
            foreach ($dict as $key => $value) {
                $query->bindValue($key, $value);    
            }
        }
        }

        return $query;
    }



}