<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    // get db
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/dbconn.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/suggestion.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tag.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tagAssignment.php');

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
        $action = 'start';
    }
    
    switch ($action)
    {
        default:
        case 'start':
            //$suggestions = suggestion_db_getSuggestions();
            $suggestions = get_representatives_records();
            $suggestions = get_representative_suggestions();
            
            include($_SERVER['DOCUMENT_ROOT'] . '/views/view_finder.php');
            break;
    }

?>