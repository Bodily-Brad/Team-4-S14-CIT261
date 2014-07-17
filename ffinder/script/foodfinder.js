var positives = new Array();        // Global array of 'positive' food codes;
                                    // foods the user prefers
var negatives = new Array();        // Global array of 'negative' food codes;
                                    // foods the user rejects

/*
 * buildNegativeArray
 * Cleans up the negatives global into an array of indexes
 * (As the icons are toggled, different indexes within the negatives array will
 * become FALSE. These indexes exist within negatives, but should not be
 * included in the cleaned array as a value of FALSE indicates the index is
 * -not- 'negative'.)
 */
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

/*
 * buildPositiveArray
 * Cleans up the positives global into an array of indexes
 * (As the icons are toggled, different indexes within the positives array will
 * become FALSE. These indexes exist within positives, but should not be
 * included in the cleaned array as a value of FALSE indicates the index is
 * -not- 'positive'.)
 */
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

/*
 * getSuggestion
 * Gets a food suggestion from the server. We do this by cleaning our two global
 * arrays (negatives and positives), and then converting them to JSON before
 * passing them to the server as an AJAX request. A callback function is then
 * set.
 * When the server responsds, we call ShowFoodSearch with the results, which
 * updates the page to show the map and suggested food type. 
 */
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
                    hideIcons();
                    showMap();
                    ShowFoodSearch(xhr.responseText);
                    localStorage.setItem("last suggestion", xhr.responseText);
                }
                else
                {
                    alert("Uh oh... something didn't quite work right. Please try again");
                }
            }
    }

    xhr.send(null);                    
}

/*
 * hideIcons
 * Hides the icons div
 * @returns none
 */
function hideIcons()
{
    $("#wrapper-home").hide();
}

/*
 * hideMap
 * Hides the map div
 * @returns none
 */
function hideMap()
{
    $("#wrapper-results").hide();    
}

function ShowFoodSearch(foodtype)
{
    document.getElementById('foodkind').innerHTML=foodtype;
    googleMap(foodtype);                  
}

/*
 * showIcons
 * Shows the Icons div
 * @returns none
 */
function showIcons()
{
    $("#wrapper-home").fadeIn(2000);    
}

/*
 * showMap
 * Shows the map div
 * @returns none
 */
function showMap()
{
    $("#wrapper-results").fadeIn(2000);    
}

/*
 * tryAgain
 * Hides the results, shows the icons, and resets the map divs
 * @returns none
 */
function tryAgain()
{
    hideMap();
    showIcons();
    document.getElementById('places').innerHTML=' ';
    document.getElementById('map-canvas').innerHTML=' '; 
    updateLastSuggestion();
}

/*
 * toggleIcon
 * This handles toggling the icon through it's different states.
 * It updates an attribute on the element, as assigns it the appropriate CSS
 * style as well.
 */
function toggleIcon(clicker, name)
{
    var status = clicker.getAttribute("status");
    if (status === null)
        status = "normal";                  

    // Set new Status based on current status
    switch (status)
    {
        case "on":
            status = "normal";
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
            positives[name] = true;
            negatives[name] = false;            
            clicker.setAttribute("status", "on");                            
            break;
        case "off":
            clicker.className = "icon-off";
            positives[name] = false;
            negatives[name] = true;            
            clicker.setAttribute("status", "off");
            break;
        default:
            clicker.className = "icon";
            positives[name] = false; // redundant
            negatives[name] = false;            
            clicker.setAttribute("status", "normal");
            break;
    }
}


function toggleListIcon(clicker, name)
{
    var status = clicker.getAttribute("status");
    if (status === null)
        status = "normal";                  

    // Set new Status based on current status
    switch (status)
    {
        case "on":
            status = "normal";
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
            clicker.className = "on";
            positives[name] = true;
            negatives[name] = false;            
            clicker.setAttribute("status", "on");                       
            break;
        case "off":
            clicker.className = "off";
            positives[name] = false;
            negatives[name] = true;              
            clicker.setAttribute("status", "off");
            break;
        default:
            clicker.className = "neutral";
            positives[name] = false;
            negatives[name] = false;            
            clicker.setAttribute("status", "normal");
            break;
    }
}

function updateLastSuggestion()
{
    var lastSug = localStorage.getItem("last suggestion");
    if (lastSug != "")
    {
        document.getElementById("lastSuggestion").innerHTML = 
                "Last Suggestion: " + lastSug;
    }    
}