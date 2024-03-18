<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <?php headContent(); ?>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= "/Evaluation-System/index.php" ?>">Home</a></li>
                <li><a href="<?= "/Evaluation-System/view/login.php" ?>">Login</a></li>
                <li><a href="<?= "/Evaluation-System/view/register.php" ?>">Register</a></li>
            </ul>
        </nav>
    </header>


    <main>
        <?php mainContent();?>
    </main>
</body>
</html>