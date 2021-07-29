
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mini CRM</title>

<style>

	table{
		width:100%;
		text-align:left;
	}
	th{
		color:green;
		font-size:20px;
		background-color:#d1f79c;
	}
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	tr:hover{
		background-color:#e8e4e3;
	}


</style>

</head>
<body>

<h1>The users in the Mini CRM database:</h1>

<table>

<tr>
	<th>Username</th>
	<th>Phone number</th>
	<th>Date of birth</th>
</tr>



<?php

session_start();

$uu=$_SESSION['username'];


//connect to database
$conn = mysqli_connect('localhost','shaun','test1234','database_name');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}


//writing a query for all pizzzas
$sql = "SELECT * FROM users WHERE username!='$uu'";

//make query ang get result
$result = mysqli_query($conn, $sql);

//output
if($result-> num_rows > 0){
	while($row = $result-> fetch_assoc()){
		echo "<tr><td>" . $row["username"] . "</td><td>" . $row["telephone"] . "</td><td>" . $row["date_of_birth"] . "</td></tr>";
	}
	echo "</table>";
}
else{
	echo "0 result";
}


//close the connection
//$conn-> close();



?>




</table>




</body>
</html>
