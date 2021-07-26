<?php

// Start the session
	session_start();
	$uu=$_SESSION['username'];




if(isset($_POST['submit3'])){
	$receiver_username = $_POST['receiver_username'];
	$text = $_POST['text'];
	

	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	


	$sql = mysqli_query($conn,"INSERT INTO mails(sender_username,receiver_username,text) values ('$uu','$receiver_username', '$text')");

	if($sql){
		
		
		echo "<script>
			alert('The mail sent succesfully!');
			window.location.href='Compose.html';
			</script>";
							
	}
	else{
		echo "<script>
			alert('Failed to send the mail!');
			window.location.href='Compose.html';
			</script>";
	}

}

?>
