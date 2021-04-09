<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login1($con);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Company Dashboard</title>
</head>
<body>

	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#2818de;">
		<a class="navbar-brand" >Dashboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link active-link" href="index1.php">Home
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Job Prerequisites</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Previous Selects</a>
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
						<h5 class="card-title">Company PROFILE</h5>
						<img src="https://cdn4.iconfinder.com/data/icons/gradient-circle-blue/36/1014-512.png" style="display: block;
						margin-left: auto;
						margin-right: auto;
						width: 50%; border-radius: 50%;"><br>
						<?php
						echo('<p class="card-text"><b>Company ID: </b>');
						echo $user_data['CID'];
						echo('<p class="card-text"><b>Name: </b>');
						echo $user_data['NAME'];
						echo('</p>');
						echo('<p class="card-text"><b>Location: </b>');
						echo $user_data['CITY'];
						echo ", ";
						echo $user_data['STATE'];
						echo('</p>');

						?>
						<a href="#" class="btn btn-primary">Edit personal info</a>
					</div>
				</div>
			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>Jobs Offered</h3>
				<div>
					<button type='button' class='btn btn-info'>Add</button>
				</div>
				<br>
				<?php
				$query="select t1.jid,t1.jobname,t1.role,t1.salary FROM JOB t1,COMPANY t2 where t1.cid=t2.cid and t2.cid={$_SESSION['uid']}";
				$result=mysqli_query($con,$query);
				echo "<table class='table'>";
				echo "<thead>";
				echo "<tr style='background-color:#96b8ff;'>";
				echo  "<th scope='col'>Job ID</th>";
				echo  "<th scope='col'>Job Name</th>";
				echo  "<th scope='col'>Role</th>";
				echo  "<th scope='col'>Salary</th>";
				echo  "<th scope='col'> </th>";
				echo  "</tr>";
				echo "</thead>";
				$j=0;
				while ($queryRow = $result->fetch_row()) {
					if($j%2==0){
						echo "<tr style='background-color:#dee8ff;'>";}
						else{
							echo "<tr style='background-color:#f5f8ff;'>";}
							for($i = 0; $i < $result->field_count; $i++){
								echo "<td>$queryRow[$i]</td>";
							}
							echo "<td><button type='button' class='btn btn-info'>Edit</button></td>";
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
