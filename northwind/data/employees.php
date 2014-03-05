<?php
$link = mysql_pconnect("localhost", "root", "root") or die("Unable To Connect To Database Server");
mysql_select_db("northwind") or die("Unable To Connect To Northwind");
 
$arr = array();
$rs = mysql_query("SELECT EmployeeID, LastName, FirstName FROM Employees");
 
while($obj[] = mysql_fetch_object($rs)) {
	$arr["data"] = $obj;
}
header("Content-type: application/json"); 
echo json_encode($arr);
