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
        case 'start':
            $suggestions = suggestion_db_getSuggestions();
            include($_SERVER['DOCUMENT_ROOT'] . '/views/view_survey.php');
            break;
        case 'view_results':
            $results = 'Chicken Alfredo';
            $pick = mt_rand(0, 2);
            switch ($pick)
            {
                case 0:
                    $results = 'Chinese Food';
                    break;
                case 1:
                    $results = 'Sushi';
                    break;
                case 2:
                    $results = 'Pizza';
                    break;
            }
            include($_SERVER['DOCUMENT_ROOT'] . '/views/view_results.php');
            break;
    }

?>