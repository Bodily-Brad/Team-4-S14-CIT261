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
                <div class="iconGrid">
                <?php
                    showIcons($suggestions);
                ?>                
                </div>
                <div class="iconGrid">
                <?php
                    showListItemIcons($suggestions);
                ?>
                </div>                
                <!-- Div for Go Button -->
                <div style='clear:both'>
                    <label id="button" onclick="getSuggestion()">Go</label>
                </div>
            </div>
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
        
        <!--JAVA SCRIPT WORKERS CODE-->
        <p id="result"></p>        
        
        <script>

            
        function ShowFoodSearch(foodtype)
        {
            document.getElementById('foodkind').innerHTML=foodtype;
            googleMap(foodtype);                  
        }
            
        </script>    
    </body>
</html>

<?php
    function showIcon($suggestion)
    {
        $name = $suggestion['name'];
        echo "<div class='icon' id='$name' onclick=\"toggleIcon(this, '$name')\">";
        echo "<p>" . $suggestion['description'] . "</p>";
        echo "</div>";
    }
    
    function showIcons($suggestions)
    {
        foreach ($suggestions as $suggestion)
        {
            showIcon($suggestion);
        }        
    }
    
    function showListItemIcon($suggestion)
    {
        echo "<li class='neutral' id='$name' onclick=\"toggleListIcon(this, '$name')\">";
        echo $suggestion['description'];
        echo "</li>";
    }
    
    function showListItemIcons($suggestions)
    {
        echo "<h1>Unordered List Version Test</h1>";
        echo "<ul>";
        foreach ($suggestions as $suggestion)
        {
            showListItemIcon($suggestion);
        }
        echo "</ul><br>";
    }
?>