<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <img src='/media/images/brand_glass.png'>
        <h1>FoodFinder</h1>
        <p><?php echo $results?></p>
        [Map]<br>
        <form method="post">
            <input type="hidden" name="action" value="start"/>
            <input type="submit" value="try again">
        </form>
    </body>
</html>