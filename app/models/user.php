<?php 
class modelUser{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    private function getSecureQuery($query, ...$params=null):PDOStatement{
        $query = $this->pdo->prepare($query);
        
        if ($params){
        foreach($params as $k => $v){
            $query->bindValue($k, $v);
        }
        }

        return $query;
    }

    private function getIdManager($sector):int{
        $query = $this->getSecureQuery("SELECT id_manager FROM managers WHERE sector_name = :sector", [":sector"=> $sector]);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC)["id_manager"];
    }
    
    public function registerUser(string $name, string $username, string $password, string $sector):bool{
        $user = $this->getUser($username);
        
        if (count($user) > 0) return false;

        $idManager = $this->getIdManager($sector);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->getSecureQuery("INSERT INTO workers(name, user, password, id_manager) VALUES (:name, :user, :password, :id_manager)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_manager" => $idManager]);
    
        $status = $query->execute();

        return $status; 
    }

    public function loginUser(string $username, $password):bool {
        $user = $this->getUser($username);
        if (count($user) === 0) return false;

        $query = $this->getSecureQuery("SELECT password FROM workers WHERE user = :user", [":user", $username]);

        $query->execute();

        $hash = $query->fetchAll(PDO::FETCH_ASSOC)["password"];
        
        return password_verify($password, $hash);
    }


    public function getUser(string $username):array {
        $query = $this->getSecureQuery("SELECT user FROM workers WHERE user = :user", [":user" => $username]);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}