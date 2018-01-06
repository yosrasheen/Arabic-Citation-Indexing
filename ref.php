<!DOCTYPE html >
<html dir="rtl" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<LINK REL=StyleSheet HREF="style.css" TYPE="text/css">
		
		  
	</head>
	<body >
		
		<div class="frame">
			<h2>المراجع</h2>
			
		</div>
		<br/>
<?php

error_reporting(E_ALL);
// get thee id 
$queryString = $_SERVER['QUERY_STRING'];
$id = substr($queryString,3);	
//connect to database
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "citation";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) 
	echo "error";
$conn->set_charset("utf8");
// get the data from citation table

$sql='SELECT * FROM `citation` WHERE `sourceId` = '.trim($id);
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	// output data of each row
	while($row = $result->fetch_assoc()) 
	{
	        //echo "sid: " . $row["sourceId"]. "<br>";
		$sid = $row["refID"];
		$sql2='SELECT * FROM `articles` where articleID="'.trim($sid).'"';
		//echo $sql2;
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) 
		{
			
			// output data of each row
			while($row2 = $result2->fetch_assoc()) 
			{
				echo  '<p style="text-align:right">' . $row2["title"]. "</p>";
				
			}
		}
	}
}
else
	echo "لا يوجد مراجع مسجلة لهذا السجل";



	

?>
	</body>
</html>

