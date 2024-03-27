
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/static/css/style.css">
    <?php echo $__env->yieldContent("head"); ?>
    </head>
<body>
    <header>
        <?php echo $__env->yieldContent("header"); ?>
        
        <nav>
            <ul>
                <?php echo $__env->yieldContent("links"); ?>
            </ul>
        </nav>
    </header>


    <main>
        <?php echo $__env->yieldContent("main"); ?>
    </main>

</body>
</html><?php /**PATH /var/www/Rating-System/app/views/global/base.blade.php ENDPATH**/ ?>