<?php

	include("connection.php");

    $arr = array();

	$stmt = $db->prepare("SELECT o.OrderID, o.ShipCity, o.ShipName, o.ShipRegion
						  FROM OrderDetails d
				  		  INNER JOIN Orders o ON d.OrderID = o.OrderID
                          WHERE d.ProductID = ?");

	if ($stmt->execute(array($_GET["ProductID"]))) {
        while ($row = $stmt->fetch()) {
            $arr[] = $row;    
        }
    }

    // add the header line to specify that the content type is JSON
    header("Content-type: application/json");
        
    echo "{\"total\":" .count($arr). ", \"data\":" .json_encode($arr). "}";

?>
