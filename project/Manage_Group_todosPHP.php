
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

		
	$sql = "SELECT group_todos.id, group_todos.title, group_todos.date FROM group_todos INNER JOIN groups ON groups.id=group_todos.group_id WHERE groups.id='$groupID'";
	

	//make query ang get result
	$result = mysqli_query($conn, $sql);

	//close the connection
	//$conn-> close();





		
// if new_todo button is pressed
if(isset($_POST['new_todo'])){
	
	$todo_title = $_POST['todo_title'];
		
	$group_id=$_SESSION['group_id'];
				
	mysqli_query($conn,"INSERT INTO group_todos (group_id,title) VALUES ('$group_id','$todo_title')");
						
	header("Location:Manage_Group_todosPHP.php");
	exit;
		
		
		
}
	
	
	
//delete task
//if 'del_task' is pressed
if(isset($_GET['del_task'])){
			
		$id=$_GET['del_task'];
			
		mysqli_query($conn,"DELETE FROM group_todos WHERE id='$id'");
		
		header("Location:Manage_Group_todosPHP.php");
		exit;
						
				
			
}

//Open member works
//if 'member_works' is pressed
if(isset($_GET['member_works'])){
								
		$_SESSION['todo_id']=$_GET['member_works'];
							
		header("Location:Member_WorksPHP.php");
		exit;
						
				
			
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

<h1>The todos in the selected group:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Tiltle</th>
	<th>Date</th>
	<th>Open the member works</th>
	<th>Delete todo</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["title"]; ?></td>
	<td><?php echo $row["date"]; ?></td>
	<td><a href="Manage_Group_todosPHP.php?member_works=<?php echo $row['id']; ?>">Open</a></td>
	<td><a href="Manage_Group_todosPHP.php?del_task=<?php echo $row['id']; ?>">X</a></td>

</tr>

<?php $i++; } ?>
</table>


<br><br><br><br>


<h2>Create a new todo in the group</h2>


<form action="Manage_Group_todosPHP.php" method="post">


	<h3>Todo title:</h3>
	<input type="text" name="todo_title">

	<input type="submit" name="new_todo" value="Create a new todo">









</body>
</html>
