
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
	$sql = "SELECT groups.name, groups.id FROM groups INNER JOIN group_administrators ON groups.id=group_administrators.groups_id INNER JOIN users ON users.id=group_administrators.users_id WHERE users.id='$resultstring'";

	//make query ang get result
	$result = mysqli_query($conn, $sql);

	
//Manage the group todos
if(isset($_GET['manage_todos'])){
	
		$_SESSION['group_id'] = $_GET['manage_todos'];
							
		header("Location:Manage_Group_todosPHP.php");
			
}




//Manage the group members
if(isset($_GET['manage_members'])){
	
		$_SESSION['group_id'] = $_GET['manage_members'];
						
		header("Location:Manage_Group_membersPHP.php");
			
}
	
	
	
	
	
//Delete the group
if(isset($_GET['delete_group'])){
	
		$group_id = $_GET['delete_group'];
		
		mysqli_query($conn,"DELETE FROM groups WHERE id='$group_id'");
			
		header("Location:Manage_groupsPHP.php");
					
}
		
	
	
		
		
// if new_group button is pressed
if(isset($_POST['new_group'])){
	
	$group_name = $_POST['group_name'];
	
	
	// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result1 = mysqli_fetch_assoc($query);
	$resultstring  = $result1['id'];
	

		
	// When I create a group, I become member and administrator of it.
	mysqli_query($conn,"INSERT INTO groups (name) VALUES ('$group_name')");
				
	// Converting MySQL query result to String
	$sqll="SELECT id FROM groups WHERE name='$group_name'";
    $queryy = mysqli_query($conn,$sqll);
    $resultt = mysqli_fetch_assoc($queryy);
	$resultstringgg  = $resultt['id'];
				
	
	mysqli_query($conn,"INSERT INTO members (group_id, user_id) VALUES ('$resultstringgg','$resultstring')");
	
	mysqli_query($conn,"INSERT INTO group_administrators (groups_id, users_id) VALUES ('$resultstringgg','$resultstring')");
		
		
	header("Location:Manage_groupsPHP.php");
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

<h1>Only the groups, where you're an administrator:</h1>

<h2>Here you colud manage the groups</h2>

<table>

<tr>
	<th>Nr.</th>
	<th>Group name</th>
	<th>Manage group todo's</th>
	<th>Manage memebers</th>
	<th>Delete group</th>
</tr>




<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["name"]; ?></td>
	<td><a href="Manage_groupsPHP.php?manage_todos=<?php echo $row['id']; ?>">Manage</a></td>
	<td><a href="Manage_groupsPHP.php?manage_members=<?php echo $row['id']; ?>">Manage</a></td>
	<td><a href="Manage_groupsPHP.php?delete_group=<?php echo $row['id']; ?>">Delete</a></td>

</tr>

<?php $i++; } ?>
</table>


<br><br><br><br><br>



<h2>Create a new group</h2>


<form action="Manage_groupsPHP.php" method="post">


	<h3>Group name:</h3>
	<input type="text" name="group_name">

	<input type="submit" name="new_group" value="Create group">



</body>
</html>
