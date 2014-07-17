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
    
    // Build Positive Tags
    $posTag = array();
    foreach ($posArr as $suggestion)
    {
        //$test = get_tagAssignments_records_by_food('pizza');
        $tags = get_tags_by_food($suggestion);
        foreach ($tags as $tag)
            $posArr[] = $tag;
    }
    
    // Get All Suggestions
    $suggestions = get_suggestions();
    
    $highRank = 0;
    $finalSuggestion = "";
    
    // Set all qualities & check Rank
    foreach ($suggestions as $suggestion)
    {
        $quals = get_tags_by_food($suggestion->name);
        foreach ($quals as $qual)
        {
            $suggestion->SetQuality($qual);
        }
        
        $rank = $suggestion->GetQualityRank($posArr) / $suggestion->GetQualityRank($quals);
        if ($rank > $highRank)
        {
            $highRank = $rank;
            $finalSuggestion = $suggestion->description;
        }
    }
    

    // Check for a 'winner' - if not, shuffle
    if ($highRank == 0)
    {
        shuffle($suggestions);

        $suggestion = array_pop($suggestions);

        $results = $suggestion->description;        
    }
    else
    {
        $results = $finalSuggestion;
    }
    
    
    echo $results;
    