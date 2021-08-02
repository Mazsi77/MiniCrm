
<?php

	// Start the session
	session_start();

	$uu=$_SESSION['username'];
	$pp=$_SESSION['password'];
	
	$todo_id=$_SESSION['todo_id'];


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
$sql = "SELECT * FROM member_works WHERE user_id='$resultstring' AND group_todos_id='$todo_id'";

//make query ang get result
$result = mysqli_query($conn, $sql);

//close the connection
//$conn-> close();






// if Upload Work button is pressed
if(isset($_POST['upload_work'])){
	

	$progress = $_POST['progress'];
		

	if(mysqli_query($conn,"INSERT INTO member_works (user_id, group_todos_id, progress) VALUES ('$resultstring','$todo_id','$progress')")){
					
		echo "<script>
				alert('Your work has been uploaded succesfully!');
				window.location.href='Upload_WorkPHP.php';
			</script>";
	}
	else{		
		echo "<script>
				alert('Failed to upload your work!');
				window.location.href='Upload_WorkPHP.php';
			</script>";
			
					
	}
}


	//delete personal work
	//if 'delete_work' is pressed
	if(isset($_GET['delete_work'])){
	
		$id=$_GET['delete_work'];
		mysqli_query($conn,"DELETE FROM member_works WHERE id='$id'");
		header("Location:Upload_WorkPHP.php");
				
	}




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

<h1>My uploaded works to the selected group todo:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Progress</th>
	<th>Date</th>
	<th>Delete my work</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["progress"]; ?></td>
	<td><?php echo $row["date"]; ?></td>
	<td><a href="Upload_WorkPHP.php?delete_work=<?php echo $row['id']; ?>">Delete</a></td>

</tr>

<?php $i++; } ?>
</table>



<br><br><br><br>



<h3>Upload a new work</h3>


<form action="Upload_WorkPHP.php" method="post">

<table>


<tr>
	<td>Work progress:</td>
	<td><input type="text" name="progress"></td>
</tr>
<tr>
	<td><input type="submit" name="upload_work" value="Upload work"></td>
</tr>
</table>






</body>
</html>
