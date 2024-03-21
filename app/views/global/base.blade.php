
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/static/css/style.css">
    @yield("head")
    </head>
<body>
    <header>
        @yield("header")
        
        <nav>
            <ul>
                @yield("links")
            </ul>
        </nav>
    </header>


    <main>
        @yield("main")
    </main>

</body>
</html>