
<?php

	// Start the session
	session_start();

	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}


	$todo_id=$_SESSION['todo_id'];



	//writing a query for all pizzzas
	$sql = "SELECT * FROM member_works INNER JOIN users ON users.id=member_works.user_id WHERE group_todos_id='$todo_id'";


	//make query ang get result
	$result = mysqli_query($conn, $sql);

	//close the connection
	//$conn-> close();


?>








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

<h1>Member works, in the selected todo:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Member name</th>
	<th>Progress</th>
	<th>Date</th>
	
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["username"]; ?></td>
	<td><?php echo $row["progress"]; ?></td>
	<td><?php echo $row["date"]; ?></td>
	

</tr>

<?php $i++; } ?>
</table>







</body>
</html>
