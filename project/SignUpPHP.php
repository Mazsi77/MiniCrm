<?php

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$telephone = $_POST['telephone'];
	

	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	$sql = mysqli_query($conn,"INSERT INTO users(username,password,telephone) values ('$username', '$password','$telephone')");

	if($sql){
		
		
		echo "<script>
			alert('Account created succesfully!');
			window.location.href='index.html';
			</script>";
							
	}
	else{
		echo "Failed to create the user.";
	}

}

?>
