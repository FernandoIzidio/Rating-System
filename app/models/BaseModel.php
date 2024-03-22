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

    public abstract function getFields(array $Fields, mixed $identifier);

   

}

       
        // $queryString = "SELECT ";
                
        // foreach ($fieldTarget as $field) { 
        //     $queryString .= $field . ",";
   
        // }
        
        // $queryString = rtrim($queryString,",") . " FROM $table WHERE $fieldFilter = :value";
    
    
        // $query = $this->getSecureQuery($queryString, [":value"=> $filterValue]);
        // try {
        //     $query->execute();
        // } catch (\PDOException $e) {
        //     throw new \Exception($e->getMessage());
        // }


        // $registers = $query->fetchAll(\PDO::FETCH_ASSOC);

        // if ($registers) {
        //     return $registers[0];
        // } else {
        //     throw new \Exception("Registro não encontrado");
        // }