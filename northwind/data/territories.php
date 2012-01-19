<?php
$employeeID = $_REQUEST["filter"]["filters"][0]["value"];

$link = mysql_pconnect("localhost", "root", "root") or die("Unable To Connect To Database Server");
mysql_select_db("northwind") or die("Unable To Connect To Northwind");
 
$arr = array();
$rs = mysql_query("SELECT TRIM(t.TerritoryDescription) AS TerritoryDescription
				   FROM Territories t
				   INNER JOIN EmployeeTerritories et ON t.TerritoryID = et.TerritoryID 
				   INNER JOIN Employees e ON et.EmployeeID = e.EmployeeID
				   WHERE e.EmployeeID = " .$employeeID);
				    
while($obj = mysql_fetch_object($rs)) {
	$arr[] = $obj;
}

// add the header line to specify that the content type is JSON
header("Content-type: application/json"); 

echo "{\"data\":" .json_encode($arr). "}";
?>