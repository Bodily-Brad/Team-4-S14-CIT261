<?php
class Tag
{
    // PUBLIC MEMBERS
    public $Name;
    public $Description;
    
    // CONSTRUCTOR
    function Tag($name, $description)
    {
        $this->Name = $name;
        $this->Description = $description;
    }
}

function tag_dbrecord_to_object($record)
{
    $var = new Tag($record['name'], $record['description']);
    return $var;
}

function tag_db_getTag($name)
{
    global $db;
    
    $query = "
        SELECT *
        FROM Tags
        WHERE name = :tag_name";
    
    try
    {
        $statement = $db->prepare($query);
        $statement->bindValue(':tag_name', $name);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $ex) {
        echo $ex->message;
        exit;
    }
}

function tag_db_getTags()
{
    global $db;
    
    $query = 
            "SELECT *
            FROM Tags";
    
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