<?php

// Start the session
session_start();

?>



<?php


// if submit button is pressed
if(isset($_POST['submit'])){
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];


	$uu=$_SESSION['username'];
	$pp=$_SESSION['password'];
	
	
	
	
	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check if the login was succesful
	$result = mysqli_query($conn,"SELECT username, password FROM users WHERE username='$uu' AND password='$pp'");
	$row = mysqli_fetch_array($result);
		
	if($row['username'] == $uu && $row['password'] == $pp){
	
				
		echo "<script>
				window.location.href='LogInMenuPHP.php';
			</script>";
	
	}
	else{
	
	
		echo "<script>
				alert('Failed to LogIn!  Wrong username or password!!');
				window.location.href='LogIn.html';
			</script>";
	
	
	}

}

?>



