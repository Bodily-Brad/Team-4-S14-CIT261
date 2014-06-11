<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
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
            include($_SERVER['DOCUMENT_ROOT'] . '/views/view_survey.php');
            break;
        case 'view_results':
            $results = 'Chicken Alfredo';
            $pick = mt_rand(0, 2);
            switch ($pick)
            {
                case 0:
                    $results = 'Chinese Pizza';
                    break;
                case 1:
                    $results = 'Western Sushi';
                    break;
                case 2:
                    $results = 'Himalayan Tofu';
                    break;
            }
            include($_SERVER['DOCUMENT_ROOT'] . '/views/view_results.php');
            break;
    }

?>