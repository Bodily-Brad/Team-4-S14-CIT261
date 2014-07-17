<?php
/**
 * @author Brad Bodily
 */

/**
 * Represents a possible suggestion, including its component qualities
 */
class Suggestion
{
    // CONSTRUCTOR
    function Suggestion($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
    
    // PUBLIC MEMBERS
    
    /**
     * The name of the suggestion
     * @var string
     */
    public $name;
    /**
     * How the suggestion is described on screen
     * @var string 
     */
    public $description;
    /**
     * A collection of componen qualities that describe this suggestion
     * @var string array
     */
    public $qualities = array();
    
    // PUBLIC FUNCTIONS
    /**
     * Clears a quality from this Suggestion's quality list
     * @param string $quality The name of the quality to clear
     */
    public function ClearQuality($quality)
    {
        if (array_key_exists($this->qualities, $quality))
        {
            unset($this->qualities[$quality]);            
        }
    }
    
    /**
     * Calculates a rank based on similarity to the specified qualities
     * @param string array $compareQualities Qualities to compare against
     * @return int quality rank
     */
    public function GetQualityRank($compareQualities)
    {
        $count = 0;
        
        foreach ($compareQualities as $key => $value)
        {
            if (array_key_exists($this->qualities, $key))
            {
                $count++;                
            }
        }
        
        return $count;
    }
    
    /**
     * Sets a quality to this Suggestion's list of qualities
     * @param string $quality Quality to set/add
     */
    public function SetQuality($quality)
    {
        $this->qualities[$quality] = true;
    }
}

function suggestion_dbrecord_to_object($record)
{
    $var = new Suggestion($record['name'], $record['description']);
    return $var;
}

function get_suggestions_records()
{
    global $db;
    
    $query = 
            "SELECT *
            FROM Suggestions";
    
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit;
    }
    
    if (!empty($results))
        return $results;
    return false;
}

function get_suggestion_record($name)
{
    global $db;
    
    $query = "
        SELECT *
        FROM Suggestions
        WHERE name = :suggestion_name";
    
    try
    {
        $statement = $db->prepare($query);
        $statement->bindValue(':suggestion_name', $name);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit;
    }
}

function get_suggestion($name)
{
    $record = get_suggestion_record($name);
    if (empty($record))
        return false;
    
    return suggestion_dbrecord_to_object($record);
}

function get_suggestions()
{
    $records = get_suggestions_records();
    $objects = array();
    
    foreach ($records as $record)
    {
        $object = suggestion_dbrecord_to_object($record);
        $objects[] = $object;
    }
    
    return $objects;
}

function get_representatives_records()
{
    global $db;
    
    // Get Rep Names
    $query = 
            "SELECT *
            FROM Representatives";
    
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit;
    }
    
    if (empty($results))
        return false;
    
    // Get Foods
    
    $query =
            "SELECT *
            FROM Suggestions
            WHERE ";
    
    $count = 0;
    foreach ($results as $result)
    {
        $query .= "name = '" . $result['name'] . "'";
        if ($count < count($results) - 1)
            $query .= " OR ";
        
        $count++;
    }
    
    try {
        $nextStatement = $db->prepare($query);
        $nextStatement->execute();
        $representatives = $nextStatement->fetchAll();
        $nextStatement->closeCursor();
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        exit;
    }    
    
    if (!empty($representatives))
        return $representatives;
    
    return false;
}

function get_representative_suggestions()
{
    $records = get_representatives_records();
    $objects = array();
    
    foreach ($records as $record)
    {
        $object = suggestion_dbrecord_to_object($record);
        $objects[] = $object;
    }
    
    return $objects;
}