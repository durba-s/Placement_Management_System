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
    $email = $user_data['EMAIL'];
    $name = $user_data['NAME'];
    $branch = $user_data['BRANCH'];
    $yoa = $user_data['YEAR'];
    $cg = $user_data['CG'];
    $hno = $user_data['HOUSENO'];
    $city = $user_data['CITY'];
    $state = $user_data['STATE'];
    $pin = $user_data['PIN'];
    $password = $user_data['PASSWORD'];
}
else die;
if($_SERVER['REQUEST_METHOD']=="POST")
{   
    //something was posted    
	if(isset($_POST['hno']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pin']) && isset($_POST['pass']))
	{   
        //fetch POSTed data
        $hno=$_POST['hno'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $pin=$_POST['pin'];
        //check if password is correct
		if($_POST['pass']==$password){
			$query="update student set houseno='$hno', city='$city', state='$state', pin='$pin' where sid='$uid' limit 1";
			$result=mysqli_query($con,$query);
            $_SESSION['success'] = "Changes successfully saved";
		}
        //display error
		else if($_POST['pass']!=$password){
            $_SESSION['edit_err']= "Incorrect password";
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
                <h3>Edit Personal Info</h3>
                <div style="color: green;">
                    <?php
                        if(isset($_SESSION['success'])){
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        }
                    ?>
                </div>
                <div>
                    <form method="POST" action="">
                      <fieldset>
                        <div class="form-group row">
                            <label for="name" class="col-1 col-form-label">Name: </label>
                            <input type="text" readonly="" class="col-2 form-control-plaintext" id="name" value="<?=$name ?>">
                        </div>
                        <div class="form-group row">
                            <label for="idno" class="col-2 col-form-label">ID Number: </label>
                              <input type="text" readonly="" class="col-2 form-control-plaintext" id="idno" value="<?=$_SESSION['uid'] ?>">
                            <label for="branch" class="col-2 col-form-label">Branch: </label>
                              <input type="text" readonly="" class="col-2 form-control-plaintext" id="branch" value="<?=$branch ?>">
                        </div>
                        <div class="form-group row">
                            <label for="cg" class="col-2 col-form-label">CGPA: </label>
                                <input type="text" readonly="" class="col-2 form-control-plaintext" id="cg" value="<?=$cg ?>">
                                <label for="yoa" class="col-2 col-form-label">Year of Admission: </label>
                                <input type="text" readonly="" class="col-1 form-control-plaintext" id="yoa" value="<?=$yoa ?>">
                        </div>
                        <div class="form-group">
                          <label for="hno">House no.</label>
                          <input type="number" class=" col-6 form-control" name="hno" id="hno" aria-describedby="emailHelp" value="<?=$hno?>">
                        </div>
                        <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" class=" col-6 form-control" name="city" id="city" value="<?=$city?>">
                        </div>
                        <div class="form-group">
                          <label for="state">State</label>
                          <input type="text" class="col-6 form-control" name="state" id="state" value="<?=$state?>">
                        </div>
                        <div class="form-group">
                          <label for="addr">PIN</label>
                          <input type="number" class="col-6 form-control" name="pin" id="pin" value="<?=$pin?>">
                        </div>
                        <div class="form-group">
                          <label for="addr">Confirm password</label>
                          <input type="password" class="col-4 form-control" name="pass" id="pass" required>
                        </div>
                        <div style="color:red;">
                            <?php
                                if(isset($_SESSION['edit_err'])){
                                    echo $_SESSION['edit_err'];
                                    unset($_SESSION['edit_err']);
                                }
                            ?>
                        </div>
                        <br/>
                        <div class="input-group"> 
                            <br>
                            <button name="submit" class="btn btn-info">Save changes</button>
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


