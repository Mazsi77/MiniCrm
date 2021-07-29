
<?php

	// Start the session
	session_start();
		
	$groupID=$_SESSION['group_id'];
	
		

//connect to database
$conn = mysqli_connect('localhost','shaun','test1234','database_name');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}


$sql = "SELECT members.joined, users.username FROM users INNER JOIN members ON users.id=members.user_id INNER JOIN groups ON groups.id=members.group_id WHERE groups.id='$groupID'";



//make query ang get result
$result = mysqli_query($conn, $sql);

//close the connection
//$conn-> close();


//}

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
		
		font-size:20px;
		background-color:#32d95f;
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

<h1>The members in the selected group:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Name</th>
	<th>Joined in the group</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["username"]; ?></td>
	<td><?php echo $row["joined"]; ?></td>
	

</tr>

<?php $i++; } ?>
</table>




</body>
</html>
