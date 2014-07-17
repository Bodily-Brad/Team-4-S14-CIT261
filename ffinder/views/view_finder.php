<html>
<?php
// Common Head
include($_SERVER['DOCUMENT_ROOT'] . '/views/elements/view_head.php');

// Requires
// $suggestions:Suggestion[]  This is an array of objects to be used as icons
?>
    <body>
        <div id="wrapper_all">
            <header>
                <a href="/"><img src="/media/images/brand_glass.png" id="logo" alt="FoodFinder"></a>
                FoodFinder
            </header>
        <!-- START/PREFERENCE SCREEN -->
        <div id="wrapper-home">      
            <!-- Div for Icons-->
            <div id="contentwrapper">
                <?php
                    showIcons($suggestions);
                ?>                
            </div>    
            <!-- Div for Go Button -->
            <div id="button" onclick="getSuggestion()">Go</div>            
        </div>
        
        <!--GOOGLE MAP & APP RESULTS-->
        <div id="wrapper-results" style="display: none;">
            <p>Based on your preferences we recommend you have . . .</p>
            <h1 id="foodkind">burgers</h1>
            Not quite right? <div id="tryAgain" onclick="tryAgain()">Try Again.</div>
            <div id="map-canvas"></div>
            <div id="results">
            <h2>Places to Get It:</h2>
            <ul id="places"></ul>
            <div id="more" class="button">More results</div>
            </div>
        </div>
        <!--END of GOOGLE MAP & APP RESULTS-->
        
        <!-- Last Suggestion -->
        <p id="lastSuggestion"></p>
        <!--JAVA SCRIPT WORKERS CODE-->
        <p id="result"></p>
        <script>
            function ShowFoodSearch(foodtype)
            {
                document.getElementById('foodkind').innerHTML=foodtype;
                googleMap(foodtype);                  
            }            
        </script>
        </div>
    </body>
</html>

<?php
    function showIcon($suggestion)
    {
        //$name = $suggestion['name'];
        $name = $suggestion->name;
        $description = $suggestion->description;
        
        echo "<div class='icon' id='$name' onclick=\"toggleIcon(this, '$name')\">";
        //echo "<p>" . $suggestion['description'] . "</p>";
        echo "<p>" . $description . "</p>";
        echo "</div>";
        echo "\n";
    }
    
    function showIcons($suggestions)
    {
        foreach ($suggestions as $suggestion)
        {
            showIcon($suggestion);
        }        
    }
    
    // These functions are not currently used
    // They build the icons as an unordered list
    function showListItemIcon($suggestion)
    {
        $name = $suggestion->name;
        $description = $suggestion->description;        
        echo "<li class='neutral' id='$name' onclick=\"toggleListIcon(this, '$name')\">";
        echo $description;
        echo "</li>";
    }
    
    function showListItemIcons($suggestions)
    {
        echo "<ul>";
        foreach ($suggestions as $suggestion)
        {
            showListItemIcon($suggestion);
        }
        echo "</ul><br>";
    }
?>