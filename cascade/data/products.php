<?php
    include("connection.php");

    $arr = array();

    $stmt = $db->prepare("SELECT ProductID, ProductName FROM Products WHERE CategoryID = ?");

    if ($stmt->execute(array($_GET["CategoryID"]))) {
        while ($row = $stmt->fetch()) {
            $arr[] = $row;    
        }
    }

    // add the header line to specify that the content type is JSON
    header("Content-type: application/json");
        
    echo "{\"data\":" .json_encode($arr). "}";
?>