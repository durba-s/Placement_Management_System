<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Student Dasboard</title>
</head>
<body>
	
	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#9e36ff;">
		<a class="navbar-brand" href="#">Dashboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link" href="index.php">Home
					</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link active-link " href="#">Preferences</a>
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
			<div class="col-md-3 col-lg-2 bg-light" id="left-nav-bar" style="padding-left:0; padding-right:0;">
				<div class="card">
					<div class="card-body bg-light">
						<h5 class="card-title">STUDENT PROFILE</h5>
						<!--<img src="https://cdn3.iconfinder.com/data/icons/login-6/512/LOGIN-10-512.png" style="display: block;
						margin-left: auto;
						margin-right: auto;
						width: 50%; border-radius: 50%;"><br> -->
						<img src="https://cdn1.iconfinder.com/data/icons/basic-22/512/1041_boy_c-512.png" style="display: block;
							margin-left: auto;
							margin-right: auto;
							width: 50%; border-radius: 50%"><br>
						<?php
						echo('<p class="card-text"><b>ID Number: </b>');
						echo $user_data['SID'];
						echo('<p class="card-text"><b>Name: </b>');
						echo $user_data['NAME'];
						echo('</p>');
						echo('<p class="card-text"><b>Branch: </b>');
						echo $user_data['BRANCH'];
						echo('</p>');
						echo('<p class="card-text"><b>Year of Admission: </b>');
						echo $user_data['YEAR'];
						echo('</p>');
						echo('<p class="card-text"><b>CGPA: </b>');
						echo $user_data['CG'];
						echo('</p>');
						echo('<p class="card-text"><b>Email : </b>');
						echo $user_data['EMAIL'];
						echo('</p>');
						echo('<p class="card-text"><b>Address </b>');
						echo('<p class="card-text"><b>House No: </b>');
						echo $user_data['HOUSENO'];
						echo('</p>');
						echo('<p class="card-text"><b>City: </b>');
						echo $user_data['CITY'];
						echo('</p>');
						echo('<p class="card-text"><b>State: </b>');
						echo $user_data['STATE'];
						echo('</p>');
						echo('<p class="card-text"><b>Pin: </b>');
						echo $user_data['PIN'];
						echo('</p>');
						echo('</p>');
						?>
						<a href="#" class="btn btn-primary">Edit personal info</a>
					</div>
				</div>

			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>My Job Preferences</h3>
				<br>
				<div>
					<button type='button' class='btn btn-info'>Add</button>
				</div>
				<br>
				<?php
				$query="select t1.jid,t3.jobname from stud_wants t1,job t3 where t1.jid=t3.jid and t1.sid={$_SESSION['uid']}";
				$result=mysqli_query($con,$query);
				echo "<table class='table'>";
				echo "<thead>";
				echo "<tr style='background-color:#e6ccff;'>";
				echo  "<th scope='col'>Job ID</th>";
				echo  "<th scope='col'>Job Name</th>";
				echo  "<th scope='col'> </th>";
				echo  "</tr>";
				echo "</thead>";
				$j=0;
				while ($queryRow = $result->fetch_row()) {
					if($j%2==0){
						echo "<tr style='background-color:#f4f0fa;'>";}
						else{
							echo "<tr style='background-color:##f8f2fa;'>";} 
							for($i = 0; $i < $result->field_count; $i++){
								echo "<td>$queryRow[$i]</td>";

							}
							echo "<td><button type='button' class='btn btn-info'>Delete</button></td>";
							echo "</tr>";
							$j=$j+1;
						}
						echo "</table>";
						?>
						
					</main>
				</div>
			</div>


			<br>
		</body>
		</html>