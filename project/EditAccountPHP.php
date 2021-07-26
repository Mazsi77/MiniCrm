<?php

	// Start the session
	session_start();

	$uu=$_SESSION['username'];
	$pp=$_SESSION['password'];
	
	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

?>



<?php

// if submitUsername button is pressed
if(isset($_POST['submitUsername'])){
	
	$username = $_POST['username'];
		
	// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
	$resultstring  = $result['id'];
	
	

	$b = mysqli_query($conn,"UPDATE users SET username='$username' WHERE id='$resultstring'");
		

	if($b){
		
		// Converting MySQL query result to String
	$sqll="SELECT username FROM users WHERE id='$resultstring'";
    $queryy = mysqli_query($conn,$sqll);
    $resultt = mysqli_fetch_assoc($queryy);
	$resultstringg  = $resultt['username'];
		
	$_SESSION['username'] = $resultstringg;
		
		echo "<script>
			alert('Username edited succesfully!');
			window.location.href='EditAccount.html';
			</script>";
							
	}
	else{
			echo "<script>
			alert('Failed to edit the username!');
			window.location.href='EditAccount.html';
			</script>";
	}

}






// if submitPassword button is pressed
if(isset($_POST['submitPassword'])){
	
	$password = $_POST['password'];
		
	// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
	$resultstring  = $result['id'];
	
	

	$b = mysqli_query($conn,"UPDATE users SET password='$password' WHERE id='$resultstring'");
		

	if($b){
		
		// Converting MySQL query result to String
	$sqll="SELECT password FROM users WHERE id='$resultstring'";
    $queryy = mysqli_query($conn,$sqll);
    $resultt = mysqli_fetch_assoc($queryy);
	$resultstringg  = $resultt['password'];
		
	$_SESSION['password'] = $resultstringg;
		
		echo "<script>
			alert('Password edited succesfully!');
			window.location.href='EditAccount.html';
			</script>";
							
	}
	else{
			echo "<script>
			alert('Failed to edit the password!');
			window.location.href='EditAccount.html';
			</script>";
	}

}



// if submitTelephone button is pressed
if(isset($_POST['submitTelephone'])){
	
	$telephone = $_POST['telephone'];
		
	// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
	$resultstring  = $result['id'];
	
	

	$b = mysqli_query($conn,"UPDATE users SET telephone='$telephone' WHERE id='$resultstring'");
		

	if($b){
				
		echo "<script>
			alert('Telephone number edited succesfully!');
			window.location.href='EditAccount.html';
			</script>";
							
	}
	else{
			echo "<script>
			alert('Failed to edit the telephone number!');
			window.location.href='EditAccount.html';
			</script>";
	}

}

?>



