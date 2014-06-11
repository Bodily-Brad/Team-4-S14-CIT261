<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/style/ffinder.css"/>        
        <title></title>
    </head>
    <body>
        <img src='/media/images/brand_glass.png'>
        <h1>FoodFinder</h1>
        <p><?php echo $results?></p>
        [Map]<br>
        <form method="post">
            <input type="hidden" name="action" value="start"/>
            <br>
            <input type="submit" value="try again" class="btn">
        </form>
    </body>
</html>