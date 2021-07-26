
<?php

	// Start the session
	session_start();

	$uu=$_SESSION['username'];
	$pp=$_SESSION['password'];



//connect to database
$conn = mysqli_connect('localhost','shaun','test1234','database_name');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}



// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
	$resultstring  = $result['id'];




//writing a query for all pizzzas
$sql = "SELECT * FROM groups INNER JOIN members ON members.group_id=groups.id INNER JOIN users ON users.id=members.user_id WHERE users.id='$resultstring'";

//make query ang get result
$result = mysqli_query($conn, $sql);


		

		
	//delete task
	//if 'del_task' is pressed
	if(isset($_GET['del_task'])){
	
		$id=$_GET['del_task'];
		mysqli_query($conn,"DELETE FROM todos WHERE id='$id'");
		header("Location:Todos.php");
				
	}
		
	

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
	tr:hover{
		background-color:#e8e4e3;
	}
	


</style>

</head>
<body>

<h1>The groups's, where I take part:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Group name</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["group_name"]; ?></td>
	<td><a href="Todos.php?del_task=<?php echo $row['id']; ?>">X</a></td>

</tr>

<?php $i++; } ?>
</table>





</body>
</html>
