<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/style/ffstyle.css"/>
        <title>Food Finder</title>
    </head>
    <body>
        <div id="contentwrapper">
            <img src='/media/images/brand_glass.png' alt='magnifying glass logo'>        
            <h1>FoodFinder</h1>
            <form method="post">
                <label class="icon" onclick="getSuggestion('gyros')">Pizza</label><input type="checkbox">
                <label class="icon" onclick="toggleIcon(this)">Pop</label><input type="checkbox">
                <label class="icon" onclick="toggleIcon(this)">Sugar</label><input type="checkbox">
                <label class="icon" onclick="toggleIcon(this)">Soda</label><input type="checkbox">
                <input type="hidden" name="action" value="view_results"/>
                <br>
                <input type="submit" value="Go" class='btn'>
            </form>
            <script>
                function getSuggestion(name)
                {
                    var xhr = new XMLHttpRequest();
                    xhr.open('get', './ajax/get_tags_by_suggestion.php?suggestionName=' + name);
                    
                    xhr.onreadystatechange =
                            function() {
                                if (xhr.readyState === 4)
                                {
                                    if (xhr.status === 200)
                                    {
                                        //alert("message: " + xhr.responseText);
                                    }
                                    else
                                    {
                                        alert('gotta prob');
                                    }
                                }
                    }
                    
                    xhr.send(null);                    
                }
                
                
                function getSomeAjax()
                {
                    var xhr = new XMLHttpRequest();
                    xhr.open('get', './ajax/send_ajax_test.php');
                    
                    xhr.onreadystatechange =
                            function() {
                                if (xhr.readyState === 4)
                                {
                                    if (xhr.status === 200)
                                    {
                                        alert("message: " + xhr.responseText);
                                    }
                                    else
                                    {
                                        alert('gotta prob');
                                    }
                                }
                    }
                    
                    xhr.send(null);
                }
                
                function toggleIcon(clicker, name)
                {
                    var status = clicker.getAttribute("status");
                    if (status === null)
                        status = "normal";                  

                    // Set new Status based on current status
                    switch (status)
                    {
                        case "on":
                            status = "off";
                            break;
                        case "off":
                            status = "normal";
                            break;
                        default:
                            status = "on";
                            break;                        
                    }
                    
                    // Set new class/attribute based on (new) current status
                    switch (status)
                    {
                        case "on":
                            clicker.className = "icon-on";
                            clicker.setAttribute("status", "on");                            
                            break;
                        case "off":
                            clicker.className = "icon-off";
                            clicker.setAttribute("status", "off");
                            break;
                        default:
                            clicker.className = "icon";
                            clicker.setAttribute("status", "normal");
                            break;
                    }
                    
                    // Get some ajax
                    getSuggestion(name);
                }
            </script>
            <?php
                showIcons($suggestions);
                //showTags($tags);
            ?>
        </div>
    </body>
</html>

<?php
    function showIcon($suggestion)
    {
        $name = $suggestion['name'];
        echo "<div class='icon' id='$name' onclick=\"toggleIcon(this, '$name')\">";
        echo $suggestion['description'];
        echo "</div>";
    }
    
    function showIcons($suggestions)
    {
        foreach ($suggestions as $suggestion)
        {
            showIcon($suggestion);
        }        
    }
    
    function showTags($tags)
    {
        foreach ($tags as $tag)
        {
            echo $tag['name'] . "<br>";
            
        }          
    }
?>