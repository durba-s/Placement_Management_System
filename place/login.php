<?php
session_start();

include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
 		//SOMETHING WAS POSTED
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	if(!empty($user_name) && !empty($password))
	{
		if($_POST['login-role']=='Student'){
			$query="select * from student where sid='$user_name' limit 1";
			$result=mysqli_query($con,$query);
			if($result){
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data=mysqli_fetch_assoc($result);
					if($user_data['PASSWORD'] == $password){
						$_SESSION['uid'] = $user_name;
						header("Location: index.php");
						die;
					}
					else{
						$_SESSION['log_error']= "Incorrect Password";
					}
					
				}
				else {$_SESSION['log_error'] = "User does not exist";}
				
			}


		}
		else if($_POST['login-role']=='Company'){
			$query="select * from company where cid='$user_name' limit 1";
			$result=mysqli_query($con,$query);
			if($result){
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data=mysqli_fetch_assoc($result);
					if($user_data['PASSWORD'] == $password){
						$_SESSION['uid'] = $user_name;
						header("Location: index1.php");
						die;
					}
					else{
						$_SESSION['log_error']= "Incorrect Password";
					}
					
				}
				else {$_SESSION['log_error'] = "User does not exist";}	
			}

		}
		/*else{
			$query="select * from admin where id='$user_name' limit 1";
			$result=mysqli_query($con,$query);
			if($result){
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data=mysqli_fetch_assoc($result);
					if($user_data['password'] == $password){
						$_SESSION['uid'] = $user_name;
						header("Location: index2.php");
						die;
					}
					else{
						$_SESSION['log_error']= "Incorrect Password";
					}

				}
				else {$_SESSION['log_error'] = "User does not exist";}	
			}

		}*/

	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Placement Management System</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 1.5rem; font-weight: 500;">Placement Management System</p>
			<img src="assets/media/log.png" style="display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%; border-radius: 50%;"><br>
			<div class="input-group" >
				<label for="logrole">Role  : </label>
				<select id="login-role" name="login-role">
					<option value="Student">Student</option>
					<option value="Company">Company</option>
					<!--<option value="Admin">Admin</option>  -->

				</select>
			</div>
			<div class="input-group">
				<input type="text" placeholder="User ID" name="user_name" value="<?php echo $text; ?>" required>
			</div>

			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div style="color:red ;">
				<?php
				if(isset($_SESSION['log_error'])){
					echo $_SESSION['log_error'];
					unset($_SESSION['log_error']);
				}
				?>

			</div>
			<div class="input-group"> 
				<br>
				<button name="submit" class="btn">Sign in</button>
			</div>
			<br>
		</form>
	</div>
</body>
</html>