
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





	//Upload my personal progress work
	//if 'upload_work' is pressed
	if(isset($_GET['upload_work'])){
	
		$_SESSION['todo_id']=$_GET['upload_work'];		
					
		header("Location:Upload_WorkPHP.php");
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

<h1>The todos in the selected group:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Tiltle</th>
	<th>Date</th>
	<th>Upload my work</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["title"]; ?></td>
	<td><?php echo $row["date"]; ?></td>
	<td><a href="Group_todosPHP.php?upload_work=<?php echo $row['id']; ?>">Upload</a></td>

</tr>

<?php $i++; } ?>
</table>




</body>
</html>
