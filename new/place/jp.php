<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login1($con);
if(isset($_POST['search'])){
	$_SESSION['jo']=$_POST['job'];
	header("Refresh:0");

}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Company Dasboard</title>
</head>
<body>
	
	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#2818de;">
		<a class="navbar-brand" >Dashboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="index1.php">Home
					</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link active-link" href="#">Job Prerequisites</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ps.php">Selections</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
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
						echo('<p class="card-text"><b>City: </b>');
						echo $user_data['CITY'];
						echo('</p>');
						echo('<p class="card-text"><b>State: </b>');
						echo $user_data['STATE'];
						echo('</p>');
						
						?>
						<a href="#" class="btn btn-primary">Edit personal info</a>
					</div>
				</div>
			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>Prerequisite Search</h3>
				<form method = "POST" id="f2">
				<?php
				echo "<label for='.pre.'>Job Name  : </label>";
				$query = "select * from job where cid={$_SESSION['uid']} order by jobname asc";
				$result=mysqli_query($con,$query);
				echo "<select name='job' id='job'>";
				while ($queryRow = $result->fetch_row()) {
					echo '<option value="'.$queryRow[0].'">'.$queryRow[2].'</option>';
				}
				echo "</select>";
				?>

				<button type="submit" class="btn btn-primary" name="search">Search</button>
			    </form>

				<?php if(isset($_SESSION['jo'])){
					$sql1="select * from job where jid={$_SESSION['jo']}";
					$result5=mysqli_query($con, $sql1);
					$queryRow1 = $result5->fetch_row();
					echo "<br>";
					echo "<b>";
					echo "Prerequisites for : ";
					echo $queryRow1[0];
					echo " ";
					echo $queryRow1[2];
					echo "</b>";
					$sql1="select t1.courseid,t2.name,t2.creds,t1.min_grade from job_req t1,course t2 where jid={$_SESSION['jo']} and t1.courseid=t2.courseid";
					$result5=mysqli_query($con, $sql1);
					echo "<table class='table'>";
								echo "<thead>";
								echo "<tr style='background-color:#96b8ff;'>";  
								echo  "<th scope='col'>CourseID</th>";
								echo  "<th scope='col'>CourseName</th>";
								echo  "<th scope='col'>Credits</th>";
								echo  "<th scope='col'>Min Grade</th>";
								echo  "</tr>";
								echo "</thead>";
								$j=0;
								while ($queryRow = $result5->fetch_row()) {
									if($j%2==0){
										echo "<tr style='background-color:#dee8ff;'>";}
										else{
											echo "<tr style='background-color:#f5f8ff;'>";} 
											for($i = 0; $i < $result5->field_count; $i++){
												echo "<td>$queryRow[$i]</td>";
											}
											echo "</tr>";
											$j=$j+1;
										}
										echo "</table>";
				}
				?>

			</main>
		</div>
	</div>


	<br>
</body>
</html>