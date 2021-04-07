<?php
session_start();
include("connection.php");
include("functions.php");
$uid = $_SESSION['uid'];
//fetch user data from database
$query = "select * from student where sid={$uid} limit 1";
$result = mysqli_query($con,$query);
if($result){
    $user_data = mysqli_fetch_assoc($result);
    $old_pass = $user_data['PASSWORD'];
}
else die;
if($_SERVER['REQUEST_METHOD']=="POST")
{   
    //something was posted    
	if(isset($_POST['new_pass']) && isset($_POST['con_new_pass']) && isset($_POST['old_pass']) && $_POST['old_pass']==$old_pass)
	{   
        //fetch POSTed data
        $new_pass=$_POST['new_pass'];
        $con_new_pass=$_POST['con_new_pass'];
        //check if both match
        if($new_pass==$con_new_pass){
			$query="update student set password='$new_pass' where sid='$uid' limit 1";
			$result=mysqli_query($con,$query);
            $_SESSION['chng_succ'] = "Password changed successfully";
		}
        //display error
		else if($_POST['old_pass']!=$old_pass){
            $_SESSION['chng_err']= "Incorrect password";
        }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Student Dasboard</title>
</head>
<style type="text/css">
	.close1{padding:.75rem 1.25rem;color:inherit}
	.close1{float:right;font-size:1.5rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5}.close1:focus,.close:hover{color:#000;text-decoration:none;opacity:.75}
	.close1:not(:disabled):not(.disabled){cursor:pointer}
	.close1{padding:0;background-color:transparent;border:0;-webkit-appearance:none}
	.close1{padding:1rem;margin:-1rem -1rem -1rem auto}
	
</style>
<body>
	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#9e36ff;">
		<a class="navbar-brand" >Dashboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link active-link" href="index.php">Home
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="stud_pref.php">Preferences</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Eligibility</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search">
				<button button type='button' class='btn btn-info' type="submit">Search</button>
			</form>
		</div>
	</header>
	<div class="container-fluid">   
		<div class="row flex-xl-nowrap">
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
                <h3>Change Password</h3>
                <div style="color: green;">
                    <?php
                        if(isset($_SESSION['chng_succ'])){
                            echo $_SESSION['chng_succ'];
                            unset($_SESSION['chng_succ']);
                        }
                    ?>
                </div>
                <div>
                    <form method="POST" action="">
                      <fieldset>
                        <div class="form-group">
                          <label for="old_pass">Old password</label>
                          <input type="passsword" class="col-4 form-control" name="old_pass" id="old_pass" required>
                        </div>
                        <div class="form-group">
                          <label for="new_pass">New password</label>
                          <input type="password" class="col-4 form-control" name="new_pass" id="new_pass" required>
                        </div>
                        <div class="form-group">
                          <label for="con_pass">Confirm new password</label>
                          <input type="password" class="col-4 form-control" name="con_new_pass" id="con_pass" required>
                        </div>
                        <div style="color:red;">
                            <?php
                                if(isset($_SESSION['chng_err'])){
                                    echo $_SESSION['chng_err'];
                                    unset($_SESSION['chng_err']);
                                }
                            ?>
                        </div>
                        <br/>
                        <div class="input-group"> 
                            <br>
                            <button name="submit" class="btn btn-info">Change password</button>
                        </div>
                        </fieldset>
                    </form>
                    <?php
                        
                    ?>
                </div>
            </main>
        </div>
    </div>

</body>
</html>


