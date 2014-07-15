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