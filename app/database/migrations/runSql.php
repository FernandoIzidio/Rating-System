<?php
require_once ("./selectSql.php");
$executeSecure = false;

if (isset($_POST['sql_files']) && is_array($_POST['sql_files'])) {

    foreach ($_POST['sql_files'] as $filename) {
        if ($filename === "insertAdmin.sql") {
            
            $executeSecure = true;
        }

        foreach ($sqlcontents as $sqlfile) {
            

            if ($sqlfile['name'] === $filename) {
                try {
                    $pdo->exec($sqlfile['content']);
                    echo "Comandos SQL do arquivo '{$filename}' foram executados com sucesso.<br>";
                } catch (\PDOException $e) {
                    echo "Erro ao executar comandos SQL do arquivo '{$filename}': " . $e->getMessage() . "<br>";
                }
            }
        }
    }
} else {
    echo "Nenhum arquivo selecionado.";
}

if ($executeSecure) {
    $query = $pdo->prepare("SELECT password FROM workers WHERE user = 'root' ");
    $query->execute();
    $password = $query->fetchAll(\PDO::FETCH_ASSOC);
    
    $hash = password_hash($password[0]["password"], PASSWORD_DEFAULT);
    
    $query = $pdo->prepare("UPDATE workers SET password = :password WHERE user = 'root'");


    $query->bindValue(':password', $hash, PDO::PARAM_STR);


    $query->execute();
}

?>
