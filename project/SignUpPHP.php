<?php

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$telephone = $_POST['telephone'];
	$date_of_birth = $_POST['date_of_birth'];
	

	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	$sql = mysqli_query($conn,"INSERT INTO users(username,password,telephone,date_of_birth) values ('$username', '$password','$telephone','$date_of_birth')");

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
