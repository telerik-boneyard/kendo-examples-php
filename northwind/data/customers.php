<?php
$link = mysql_pconnect("localhost", "root", "root") or die("Could not connect");
mysql_select_db("northwind") or die("Could not select database");
 
$arr = array();
$rs = mysql_query("SELECT EmployeeID, LastName, FirstName FROM Employees");
 
while($obj = mysql_fetch_object($rs)) {
	$arr[] = $obj;
}
header("Content-type: application/json"); 
echo "{\"data\":" .json_encode($arr). "}";
?>