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

function tagAssignment_db_getTagAssignmentsByFood($foodName)
{
    global $db;
    
    $query = "
        SELECT *
        FROM TagAssignments
        WHERE foodName = :tagAssignment_foodName";
    
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

function tagAssignment_db_getTagAssignments()
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