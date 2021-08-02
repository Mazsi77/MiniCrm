
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




//query, to show the groups, where I take part
$sql = "SELECT groups.name, groups.id FROM groups INNER JOIN members ON members.group_id=groups.id INNER JOIN users ON users.id=members.user_id WHERE users.id='$resultstring'";




//make query ang get result
$result = mysqli_query($conn, $sql);


	//show todos in the group
	//if 'show_todos' is pressed
	if(isset($_GET['show_todos'])){
	
		$_SESSION['group_id'] = $_GET['show_todos'];
		
		header("Location:Group_todosPHP.php");
			
	}

	
	//show memebers in the group
	//if 'show_members' is pressed
	if(isset($_GET['show_members'])){
	
		$_SESSION['group_id'] = $_GET['show_members'];
		
		header("Location:Group_membersPHP.php");
			
	}
		
		
		
		
	//leave the group
	//if 'leave_group' is pressed
	if(isset($_GET['leave_group'])){
	
		$group_id = $_GET['leave_group'];
		
		mysqli_query($conn,"DELETE FROM members WHERE members.group_id='$group_id' AND members.user_id='$resultstring'");
		mysqli_query($conn,"DELETE FROM group_administrators WHERE groups_id='$group_id' AND users_id='$resultstring'");
	
		header("Location:GroupsPHP.php");
				
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

<h1>All the groups's, where I take part:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Group name</th>
	<th>The todo's in the group</th>
	<th>The members in the group</th>
	<th>Leave the group</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["name"]; ?></td>
	<td><a href="GroupsPHP.php?show_todos=<?php echo $row['id']; ?>">Let's see</a></td>
	<td><a href="GroupsPHP.php?show_members=<?php echo $row['id']; ?>">Show it</a></td>
	<td><a href="GroupsPHP.php?leave_group=<?php echo $row['id']; ?>">Leave</a></td>

</tr>

<?php $i++; } ?>
</table>





</body>
</html>
