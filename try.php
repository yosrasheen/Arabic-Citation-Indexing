<?php
$conn=null;
function openConnection(&$conn)
{
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
}

function closeConnection(&$conn)
{
	$conn->close();
}
	
	/*$sql='SELECT * FROM `articles` where title="وعي طلبة الجامعة الإسلامية الجدد بقيم الحياة الزوجية الإسلامية ودور التربية في تنميته"';
	openConnection($conn);
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
			$id= $row["articleID"];
	}	
	else 
		echo "Error getid: " . $sql . "<br>" . $conn->error. "<br><br>";
	closeConnection($conn);
	echo $id;*/
function getId($sql,$field)
{
	openConnection($conn);
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
		while($row = $result->fetch_assoc()) 
			$id= $row[$field];
	else 
		echo "Error getid: " . $sql . "<br>" . $conn->error. "<br><br>";
	closeConnection($conn);
	echo "<br> the id from getid ". $id . "<br>";
}


$sql="SELECT MAX(`articleID`) as maxa FROM `articles`";	
						$refId=getId($sql, "maxa");
?>	
