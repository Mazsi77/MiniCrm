
<?php

	// Start the session
	session_start();

	$uu=$_SESSION['username'];
	

?>





<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>

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


</style>

</head>
<body>

<h1>Your inbox:</h1>

<table>

<tr>
	<th>From</th>
	<th>Text</th>
	<th>Time</th>
</tr>



<?php


//connect to database
$conn = mysqli_connect('localhost','shaun','test1234','database_name');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}


//writing a query for all pizzzas
$sql = "SELECT * FROM mails WHERE receiver_username='$uu'";

//make query ang get result
$result = mysqli_query($conn, $sql);

//output
if($result-> num_rows > 0){
	while($row = $result-> fetch_assoc()){
		echo "<tr><td>" . $row["sender_username"] . "</td><td>" . $row["text"] . "</td><td>" . $row["date"] . "</td></tr>";
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
