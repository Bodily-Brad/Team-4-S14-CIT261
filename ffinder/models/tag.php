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

function get_tag($name)
{
    $record = get_tag_record($name);
    if (empty($record))
        return false;
    
    return tag_dbrecord_to_object($record);
}

function get_tags()
{
    $records = get_tags_records();
    $objects = array();
    
    foreach ($records as $record)
    {
        $object = tag_dbrecord_to_object($record);
        $objects[] = $object;
    }
    
    return $objects;
}

function get_tag_record($name)
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

function get_tags_records()
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