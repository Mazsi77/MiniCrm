
<?php

	// Start the session
	session_start();
		
	$uu=$_SESSION['username'];
		
	$groupID=$_SESSION['group_id'];
	
		
	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

			
	$sql = "SELECT members.joined, users.username, users.id FROM users INNER JOIN members ON users.id=members.user_id INNER JOIN groups ON groups.id=members.group_id WHERE groups.id='$groupID' AND users.username!='$uu'";

	//make query ang get result
	$result = mysqli_query($conn, $sql);

	//close the connection
	//$conn-> close();


	
	

// Give admin acces
if(isset($_GET['give_acces'])){
			
		$id=$_GET['give_acces'];
			
		mysqli_query($conn,"INSERT INTO group_administrators (groups_id, users_id) VALUES ('$groupID','$id')");
		
		header("Location:Manage_Group_membersPHP.php");
		exit;
						
							
}

	

// Remove member from the group
if(isset($_GET['remove_member'])){
			
		$id=$_GET['remove_member'];
			
		mysqli_query($conn,"DELETE FROM members WHERE user_id='$id'");
		
		header("Location:Manage_Group_membersPHP.php");
		exit;
				
			
}





// Add new member into the group
if(isset($_POST['new_member'])){
	
	$group_id=$_SESSION['group_id'];
	
	$member_name = $_POST['member_name'];
		
	// Converting MySQL query result to String
	$sqll="SELECT id FROM users WHERE username='$member_name'";
    $queryy = mysqli_query($conn,$sqll);
    $resultt = mysqli_fetch_assoc($queryy);
	$resultstringg  = $resultt['id'];
				
	
	if(mysqli_query($conn,"INSERT INTO members (group_id,user_id) VALUES ('$group_id','$resultstringg')")){
				
		echo "<script>
				window.location.href='Manage_Group_membersPHP.php';
			</script>";
	
	}
	else{
	
		echo "<script>
				alert('Failed to add the member!  Wrong username!');
				window.location.href='Manage_Group_membersPHP.php';
			</script>";
	
	
	}
		
		
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

<h1>The members in the selected group:</h1>

<table>

<tr>
	<th>Nr.</th>
	<th>Name</th>
	<th>Joined in the group</th>
	<th>Give admin acces</th>
	<th>Remove from the group</th>
</tr>





<?php $i=1; while ($row=mysqli_fetch_array($result)) { ?>

<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row["username"]; ?></td>
	<td><?php echo $row["joined"]; ?></td>
	<td><a href="Manage_Group_membersPHP.php?give_acces=<?php echo $row['id']; ?>">Give</a></td>
	<td><a href="Manage_Group_membersPHP.php?remove_member=<?php echo $row['id']; ?>">Remove</a></td>

</tr>

<?php $i++; } ?>
</table>



<br><br><br><br>


<h2>Add new member into the group</h2>


<form action="Manage_Group_membersPHP.php" method="post">


	<h3>Member name:</h3>
	<input type="text" name="member_name">

	<input type="submit" name="new_member" value="Add member">








</body>
</html>
