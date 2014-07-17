<?php
    header('Content-Type: text/plain');
    header("Cache-Control: no-cache,no-store");
    
    // get db & models
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/dbconn.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/suggestion.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tag.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tagAssignment.php');    
    
    // Get the suggestion name
    // Get the action to perform
    if (isset($_POST['action']))
    {
        $action = $_POST['action'];
    }
    else if (isset($_GET['action']))
    {
        $action = $_GET['action'];
    }
    else
    {
        $action = 'get';
    }
    
    if (isset($_POST['suggestionName']))
    {
        $suggestionName = $_POST['suggestionName'];
    }
    else if (isset($_GET['suggestionName']))
    {
        $suggestionName = $_GET['suggestionName'];
    }
    else
    {
        $suggestionName = 'pizza';
    }    
    
    
    $suggestion = get_suggestion_record($suggestionName);
//    $return = json_encode($suggestion);
    
    //$suggestions = suggestion_db_getSuggestions();
    $result = json_encode($suggestion);
    
    echo $result;
?>