<?php

class TagAssignment
{
    // PUBLIC MEMBERS
    public $SuggestionName;
    public $TagName;
    
    // CONSTRUCTOR
    function TagAssignment($suggestionName, $tagName)
    {
        $this->SuggestionName = $suggestionName;
        $this->TagName = $tagName;
    }
}

function tagAssignment_dbrecord_to_object($record)
{
    $var = new TagAssignment($record['suggestionName'], $record['tagName']);
    return $var;
}

function get_tagAssignments_records_by_food($foodName)
{
    global $db;
    
    $query = "
        SELECT *
        FROM TagAssignments
        WHERE suggestionName = :tagAssignment_foodName";
    
    try
    {
        $statement = $db->prepare($query);
        $statement->bindValue(':tagAssignment_foodName', $foodName);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    } catch (PDOException $ex) {
        echo $ex->message;
        exit;
    }
}

function get_tags_by_food($foodName)
{
    $records = get_tagAssignments_records_by_food($foodName);
    $tags = array();
    
    foreach ($records as $record)
    {
        $tags[] = $record['tagName'];
    }
    
    return $tags;    
}

function get_tagAssignments_records()
{
    global $db;
    
    $query = 
            "SELECT *
            FROM TagAssignmets";
    
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->message;
        exit;
    }
    
    if (!empty($results))
        return $results;
    return false;    
}