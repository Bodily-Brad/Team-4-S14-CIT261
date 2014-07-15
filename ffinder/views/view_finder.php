<html>
<?php
// Common Head
include($_SERVER['DOCUMENT_ROOT'] . '/views/elements/view_head.php');
?>
    <body>
        <!-- START/PREFERENCE SCREEN -->
        <div id="wrapper-home">        
            <div id="contentwrapper">
                <a href="/"><img src="/media/images/logo.png" id="logo" alt="FoodFinder"></a>
                <!-- Div for Icons-->
                <div>
                <?php
                    showIcons($suggestions);
                ?>                
                </div>
                <!-- Div for Go Button -->
                <div>
                    <label id="button" onclick="getSuggestion()">Go</label>
                </div>
            </div>
        </div>
        
        <!--GOOGLE MAP & APP RESULTS-->
        <div id="wrapper-results" style="display: none;">
            <p>Based on your preferences we recommend you have . . .</p>
            <h1 id="foodkind">burgers</h1>
            Not quite right? <div id="tryAgain">Try Again.</div>
            <div id="map-canvas"></div>
            <div id="results">
            <h2>Places to Get It:</h2>
            <ul id="places"></ul>
            <div id="more" class="button">More results</div>
            </div>
        </div>
        <!--END of GOOGLE MAP & APP RESULTS-->
        
        <!--JAVA SCRIPT WORKERS CODE-->
        <p id="result"></p>        
        
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
                                    //return xhr.responseText;
                                    var responseText = xhr.responseText;
                                    document.getElementById('foodkind').innerHTML=responseText;
                                    googleMap(responseText);                                    
                                    //alert("message: " + responseText);
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

            function getFoodkind()
            {
                return "pizza";
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
?>