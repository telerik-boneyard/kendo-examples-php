<?php
    include("connection.php");

    $arr = array();

    $stmt = $db->prepare("SELECT StateID, StateName FROM USStates WHERE StateName LIKE ?");

    if ($stmt->execute(array($_GET["StartsWith"]. "%"))) {
        while ($row = $stmt->fetch()) {
            $arr[] = $row;    
        }
    }

    // add the header line to specify that the content type is JSON
    header("Content-type: application/json");
        
    echo "{\"data\":" .json_encode($arr). "}";
?>