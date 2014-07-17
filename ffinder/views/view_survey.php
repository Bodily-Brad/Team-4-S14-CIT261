<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/style/ffstyle.css"/>
        <title>Food Finder</title>
    </head>
    <body>
        <a href="/"><img src="/media/images/logo.png" id="logo" alt="FoodFinder"></a>
        <div id="contentwrapper">
            
            <form method="post">
                <label id="button" onclick="getSuggestion()">Go</label>
                <input type="hidden" name="action" value="view_results"/>
                <br>
                <input type="submit" value="Get Results" class='btn'>
            </form>
            <script>
                var positives = new Array();
                var negatives = new Array();
                
                function buildPositiveArray()
                {
                    var posArr = new Array();
                    for (var index in positives )
                    {
                        if (positives[index])
                            posArr.push(index);
                    }
                    
                    return posArr;
                }
                
                function buildNegativeArray()
                {
                    var negArr = new Array();
                    for (var index in negatives)
                    {
                        if (negatives[index])
                            negArr.push(index);
                    }
                    
                    return negArr;
                }
                
                function getSuggestion()
                {
                    var posArr = JSON.stringify(buildPositiveArray());
                    var negArr = JSON.stringify(buildNegativeArray());
                    
                    var url = './ajax/get_suggestion.php';
                    var params =
                            "positives=" + posArr + "&" +
                            "negatives=" + negArr;
                    
                    var xhr = new XMLHttpRequest();
                    xhr.open('get', url + "?" + params);
                    
                    xhr.onreadystatechange =
                            function() {
                                if (xhr.readyState === 4)
                                {
                                    if (xhr.status === 200)
                                    {
                                        //alert("message: " + xhr.responseText);
                                        // Add Google Map Code Here
                                        // xhr.responseText = returned Food Type
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
                            positives[name] = false;
                            negatives[name] = true;
                            break;
                        case "off":
                            status = "normal";
                            positives[name] = false; // redundant
                            negatives[name] = false;
                            break;
                        default:
                            status = "on";
                            positives[name] = true;
                            negatives[name] = false;
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