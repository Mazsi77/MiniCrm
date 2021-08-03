<?php

			// Start the session
			session_start();

			$uu=$_SESSION['username'];
			$pp=$_SESSION['password'];

			//echo "<br><h1>" . "Welcome " . $uu . " !" . "</h1>";

		?>

<?php


//connect to database
$conn = mysqli_connect('localhost','shaun','test1234','database_name');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}


//writing a query for all pizzzas
$sql = "SELECT todos.id, todos.title, todos.description, todos.date FROM todos INNER JOIN users ON users.id=todos.user_id WHERE users.username='$uu' AND users.password='$pp'";

//make query ang get result
$result = mysqli_query($conn, $sql);

//close the connection
//$conn-> close();


?>

<?php

	//connect to database
	$conn = mysqli_connect('localhost','shaun','test1234','database_name');

	//check connection
	if(!$conn){
		echo 'Connection Error: ' . mysqli_connect_error();
	}
	
	
	

// if submit2 button is pressed
if(isset($_POST['submit2'])){
	
	$title = $_POST['title'];
	$description = $_POST['description'];
	
	
	// Converting MySQL query result to String
	$sql="SELECT id FROM users WHERE username='$uu' AND password='$pp'";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($query);
	$resultstring  = $result['id'];
	

	

	if(mysqli_query($conn,"INSERT INTO todos (title, user_id, description) VALUES ('$title','$resultstring','$description')")){
		
		// to prevent to go back in the page, and the page would be re-updated with the old value.
		header("Location: LogInMenuPHP.php");
		exit;
	}
	else{
		echo "Failed to insert the todo.";
	}
		
}
		
	
	//delete task
	//if 'del_task' is pressed
	if(isset($_GET['del_task'])){
	
		$id=$_GET['del_task'];
		mysqli_query($conn,"DELETE FROM todos WHERE id='$id'");
		header("Location: LogInMenuPHP.php");
				
	}
		
	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Mini CRM</title>
		<link rel="stylesheet" href="./Styles/universalstyles.css">
		<style>
			*{
				box-sizing: border-box;
			}
			body{
				display: flex;
				flex-direction: row;
				background-color: #CFD7E9;
			}
			.sideMenu{
				position: fixed;
				width: 20vw;
				height: 100%;
				background-color: #101C29;
				display: flex;
				flex-direction: column;
				color:white;
				padding: 0 0 0 1.4em ;
			}
			.others{
				padding-left: 20vw;
			}
			.others > *{
				padding: 0 2em;
			}
			header{
				width: 100%;
				height: 80px;
				background-color: white;
				width: 80vw;
			}
			.sideMenu h3{
				color: #647CAB;
				font-weight: bold;
				font-size: 1.25rem;
			}
			ul{
				list-style: none;
			}
			ul a{
				color: white;
				text-decoration: none;
				padding: 1em;
				display: block;
				width: 100%;
			}
			ul li{
				border-radius: 20px 0 0 20px;
			}

			ul li b:nth-child(1){
				position: absolute;
				top: -20px;
				height: 20px;
				width: 100%;
				background-color: #CFD7E9;
			}
			ul li b:nth-child(1)::before{
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				border-bottom-right-radius: 20px;
				background-color: #101C29;
			}
			ul li b:nth-child(2){
				position: absolute;
				bottom: -20px;
				height: 20px;
				width: 100%;
				background-color: #CFD7E9;
			}
			ul li b:nth-child(2)::before{
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				border-top-right-radius: 20px;
				background-color: #101C29;
			}
			.active{
				position: relative;
				background-color: #CFD7E9;
				color: #101C29;
				
			}
			.active a{
				color:#101C29;
			}
			ul li a:hover{
				color: #647CAB;
			}
			.tittle{
				margin-top: 1.3em;
				display: flex;
				flex-direction: row;
				justify-content: space-between;
				align-items: center;
				margin-bottom: 2rem;
			}
			.content input[type=button], .content input[type=submit]{
				text-decoration: none;
				color: black;
				background-color: #F9B403;
				border: none;
				padding: 0.5rem 1.5rem;
				font-family: 'Cairo', sans-serif;
				font-size: 1.2rem;
				font-weight: 600;
				border-radius: 10px;
			}
			.tittle h2{
				font-size: 1.6rem;
				font-family: 'Cairp', sans-serif;
				font-weight: 600;

			}
			.card{
				background-color: #B8C0CF;
				padding: 1rem;
				border-radius: 20px;
				border-top: 5px solid #F9B403;
				margin: 1.3rem 0;
				font-size: 1rem;
			}
			.card h2{
				padding-top: 0;
				margin-top: 0;
				font-size: 1.5rem;
			}
			.card hr{
				border: 1px solid #CFD7E9;
				margin: 1rem 0;
			}
			.card a{
				text-decoration: none;
				color: white;
				background-color: #101C29;
				padding: .5em 1.5em;
				border-radius: 10px;
			}
			.details{
				display: flex;
				flex-direction: row;
				justify-content: space-between;
				align-items: center;
				font-size: .9rem;
			}
			.details p{
				padding: 0;
				margin: 0;
			}
			.details span{
				font-weight: bold;
			}
			.hidden{
				display: none;
			}
			form{
				display: flex;
				flex-direction: row;
				justify-content: space-between;
				align-items: center;
				font-size: 1.2rem;
			}
			form input[type=text]{
				width: 30%;
				border: none;
				padding: .5em 1em;
				font-size: 1.3rem;
				border-radius: 10px;
				border-bottom: #F9B403 3px solid;
			}
		</style>
		<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
	</head>

	<body>

		<aside class="sideMenu">
			<h1 class="logo">Mini<span>CRM</span></h1>

			<h3>Personal</h3>
			<ul>
				<li class="active">
					<b></b>
					<b></b>
					<a href="LogInMenuPHP.php">To Do</a>
				</li>
				<li>
					<a href="MailsMenu.html">Messages</a>
				</li>
				<li>
					<a href="EditAccount.html">Edit Account</a>
				</li>
			</ul>
			<h3>Groups</h3>
			<ul>
				<li>
					<a href="GroupsMenu.html">To Do</a>
				</li>
				<li>
					<a href="#">Members</a></li>
				<li>
					<a href="Manage_Group_membersPHP.php">Manage</a>
				</li>
			</ul>
		</aside>
		<section class="others">
			<header>
				<a href="#">Add New</a>
			</header>
			<section class="content">
				<!-- <div class="switch">
					<a href="#">Active</a>
					<a href="#">Completed</a>
				</div> -->

				<div class="tittle">
					<h2>Personal Todo's</h2>
					<input id="formToggle" type="button" value="New To Do" />
				</div>
				<form id="addTodo" class="hidden" action="LogInMenuPHP.php" method="post">
					<label for="title">Title</label>
					<input type="text" name="title" required>
					<br><br>
					<label for="description">Description</label>
					<input type="text" name="description" required>
					<input type="submit" value="Add todo" name="submit2">
				</form>
				<div class="todos">
					

				<?php 
				$i=1; 
				while ($row=mysqli_fetch_array($result)) { ?>
				<div class="card">
					<h2><?php echo $row["title"]; ?></h2>
					<p><?php echo $row["description"]; ?></p>
					<a href="LogInMenuPHP.php?del_task=<?php echo $row['id']; ?>">Delete</a>
					<hr>
					<div class="details">
					<p><?php echo $row["date"]; ?></p>
					<p>Status: <span>Not Started</span></p></div>
				</div>
				<?php $i++; }
				if($i==1){ ?>
					<p>Nothing is on your ToDo List :(</p>
					<?php } ?>
				</div>
			</section>
		</section>
		<!--<div class="Conatainer">
			<div class="small_div"><a href="GroupsMenu.html">Open Groups Menu</a></div>
			<div class="small_div"><a href="MailsMenu.html">Open the Mails Menu</a></div>
			<div class="small_div"><a href="Todos.php">Your todos</a></div>
			<div class="small_div"><a href="Users.php">Other users</a></div>
			<div class="small_div"><a href="EditAccount.html">Edit your account</a></div>
			
		</div>


		
	-->
	<script>
			$("#formToggle").click(function()	{
				if(! $("#addTodo").hasClass("hidden")) $(this).prop('value', 'New To Do')
				else $(this).prop('value', 'Cancel');
				$("#addTodo").toggleClass("hidden")});

	</script>
	</body>
</html>
