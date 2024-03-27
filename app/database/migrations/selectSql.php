<?php
use Dotenv\Dotenv;



$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();






try {
    $pdo = new \PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}


$subdirs = scandir("../sql/");


$subdirs = array_diff($subdirs, ['.', '..', "runSql.php", "selectSql.php"]);


$sqlcontents = [];

foreach ($subdirs as $subdir) {
    $subdirPath =  "../sql/" . $subdir . "/";

    $subdir = array_diff(scandir($subdirPath), ['.', "..", "runSql.php", "selectSql.php"]);
    foreach ($subdir as $file){
        $filePath  = $subdirPath . $file;

        $fdesc = fopen($filePath, 'r');
        $sqlstring = fread($fdesc, filesize($filePath));
        
        array_push($sqlcontents, ["name" => $file, "content" => $sqlstring]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executar SQL</title>
</head>
<body>
    <h1>Selecione os arquivos SQL para executar:</h1>
    <form action="runSql.php" method="post">
        <?php foreach ($sqlcontents as $sqlfile): ?>
            <label>
                <input type="checkbox" name="sql_files[]" value="<?= $sqlfile['name'] ?>">
                <?= $sqlfile['name'] ?>
            </label>
            <br>
        <?php endforeach; ?>
        <button type="submit">Executar</button>
    </form>
</body>
</html>
