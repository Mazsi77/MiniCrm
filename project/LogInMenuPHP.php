
<?php

	// Start the session
	session_start();

	$uu=$_SESSION['username'];
	$pp=$_SESSION['password'];

	echo "<br><h1>" . "Welcome " . $uu . " !" . "</h1>";

?>





<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<style>

*{
	text-align:center;
	margin:0px;
	padding:0px;
	box-sizing:border-box;
}

.Conatainer{
	width:900px;
	height:250px;
	display:flex;
    flex-direction: row;
    justify-content:space-around;
	background-color:#32a852;
    margin:0px auto;
    margin-top:40px;
    padding-top:80px;
}

.small_div{
	width:150px;
	height:80px;
	display:inline-block;
	background-color:orange;
    padding-top:30px;
}

.small_div a{
	text-decoration:none;
}

.small_div:hover{
	background-color:#bd8a3e;
    cursor:pointer;
    font-size:17px;
}

a{
	display:block;
    width:100%;
    height:100%;   
	color:black;
}

</style>

</head>
<body>

<br>

<h2>Here is the Logged In Menu</h2>
<br>
<h2>Click the link below:</h2>

<div class="Conatainer">
	<div class="small_div"><a href="Todos.php">Your todos</a></div>
	<div class="small_div"><a href="Users.php">Other users</a></div>
	<div class="small_div"><a href="MailsMenu.html">Open the Mails Menu</a></div>
	<div class="small_div"><a href="EditAccount.html">Edit your account</a></div>
	<div class="small_div"><a href="GroupsMenu.html">Open Groups Menu</a></div>
</div>



</body>
</html>
