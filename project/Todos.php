
<?php

	// Start the session
	session_start();

	$uu=$_SESSION['username'];
	$pp=$_SESSION['password'];

?>





<?php


//connect to database
$conn = mysqli_connect('localhost','shaun','test1234','database_name');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}


//writing a query for all pizzzas
$sql = "SELECT todos.id, todos.title, todos.date FROM todos INNER JOIN users ON users.id=todos.user_id WHERE users.username='$uu' AND users.password='$pp'";

//make query ang get result
$result = mysqli_query($conn, $sql);

//close the connection
//$conn-> close();


?>






<?php

	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}
	
	
	

// if submit2 button is pressed
if(isset($_POST['submit2'])){
	
	$title = $_POST['title'];
	
	
	
	// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
	$resultstring  = $result['id'];
	

	

	if(mysqli_query($conn,"INSERT INTO todos (title,user_id) VALUES ('$title','$resultstring')")){
		
		// to prevent to go back in the page, and the page would be re-updated with the old value.
		header("Location:Todos.php");
		exit;
	}
	else{
		echo "Failed to insert the todo.";
	}
		
}
		
	
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

<h1>My personal todos:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Todo title</th>
	<th>Date</th>
	<th>Action</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["title"]; ?></td>
	<td><?php echo $row["date"]; ?></td>
	<td><a href="Todos.php?del_task=<?php echo $row['id']; ?>">X</a></td>

</tr>

<?php $i++; } ?>
</table>



<br><br><br><br>



<h3>Add a new todo</h3>


<form action="Todos.php" method="post">

<table>


<tr>
	<td>Todo name</td>
	<td><input type="text" name="title"></td>
</tr>
<tr>
	<td><input type="submit" name="submit2" value="Add todo"></td>
</tr>
</table>






</body>
</html>
