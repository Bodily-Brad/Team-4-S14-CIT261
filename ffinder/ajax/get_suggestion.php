<?php

// This function will need two parameters:
// positives: array of positive food names
// negatives: array of negative food names

    header('Content-Type: text/plain');
    header("Cache-Control: no-cache,no-store");
    
    // get db & models
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/dbconn.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/suggestion.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tag.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/tagAssignment.php');

    // Get parameters
    if (isset($_POST['positives']))
    {
        $positives = $_POST['positives'];
    }
    else if (isset($_GET['positives']))
    {
        $positives = $_GET['positives'];
    }
    else
    {
        $positives = '[]';
    }
    
    if (isset($_POST['negatives']))
    {
        $negatives = $_POST['negatives'];
    }
    else if (isset($_GET['negatives']))
    {
        $negatives = $_GET['negatives'];
    }
    else
    {
        $negatives = '[]';
    }
    
    // JSON -> Array
    $posArr = json_decode($positives);
    $negArr = json_decode($negatives);
   
    echo "pos: ";
    foreach ($posArr as $item)
        echo $item . ", ";
    
    echo "neg: ";
    foreach ($negArr as $item)
        echo $item . ", ";
    