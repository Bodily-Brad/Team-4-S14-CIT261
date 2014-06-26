<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/style/ffstyle.css"/>
        <title></title>
    </head>
    <body>
        <span id="contentwrapper">
            <img src='/media/images/brand_glass.png'>        
            <h1>FoodFinder</h1>
            <form method="post">
                <label class="icon" onclick="toggleIcon(this)">Pizza</label><input type="checkbox">
                <label class="icon" onclick="toggleIcon(this)">Pop</label><input type="checkbox">
                <label class="icon" onclick="toggleIcon(this)">Sugar</label><input type="checkbox">
                <label class="icon" onclick="toggleIcon(this)">Soda</label><input type="checkbox">
                <input type="hidden" name="action" value="view_results"/>
                <br>
                <input type="submit" value="Go" class='btn'>
            </form>
            <script>
                function toggleIcon(clicker)
                {
                    var status = clicker.getAttribute("status");
                    if (status === null)
                        status = "off";                  
                    window.alert(status);
                    if (status == "off")
                        clicker.setAttribute("status", "on");
                    else
                        clicker.setAttribute("status", "off");
                }
            </script>
        </span>
    </body>
</html>
