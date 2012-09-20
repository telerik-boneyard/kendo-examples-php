<?php
    include("connection.php");

    $arr = array();

    foreach($db->query("SELECT CategoryID, CategoryName FROM Categories") as $row) {
        $arr[] = $row;
    }

    // add the header line to specify that the content type is JSON
    header("Content-type: application/json");
        
    echo "{\"data\":" .json_encode($arr). "}";
?>