<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/style/ffstyle.css"/>        
        <title></title>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
        <script src="/models/mapAPI.js"></script>

    </head>
    <body>
        <span id="contentwrapper">        
            <img src='/media/images/brand_glass.png'>
            <h1>FoodFinder</h1>
            <p id="foodkind"><?php echo $results?></p>
            <div id="map-canvas"></div>
            <div id="results">
              <h2>Places to Get It:</h2>
              <ul id="places"></ul>
              <div id="more" class="button">More results</div>
            </div>         
        </span>
        <form method="post">
            <input type="hidden" name="action" value="start"/>
            <br>
            <input type="submit" value="try again" class='btn'>
        </form>        
    </body>
</html>