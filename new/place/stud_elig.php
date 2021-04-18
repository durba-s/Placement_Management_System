<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">




	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable( {
				"pagingType": "full_numbers"
			} );
		} );  
	</script>
	<title>Student Dasboard</title>
</head>
<body>

	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#390669;">
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
				<li class="nav-item ">
					<a class="nav-link" href="stud_pref.php">Preferences</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link active-link" href="#">Eligibility</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="jobquery.php">View Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="jobfilter.php">Filter Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
			<!--<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search">
				<button button type='button' class='btn btn-info' type="submit">Search</button>
			</form>-->
		</div>
	</header>
	<div class="container-fluid">
		<div class="row flex-xl-nowrap">
			<div class="col-md-3 col-lg-2 bg-light" id="left-nav-bar" style="padding-left:0; padding-right:0; background: #7107b8; height: 100%;">
				<div class="card">
					<div class="card" style="padding: 1rem;background-color:#b866ff; color: white;">
						<h5 class="card-title"><b>STUDENT PROFILE</b></h5>
						<!--<img src="https://cdn3.iconfinder.com/data/icons/login-6/512/LOGIN-10-512.png" style="display: block;
						margin-left: auto;
						margin-right: auto;
						width: 50%; border-radius: 50%;"><br> -->
						<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnpJht7IsCBSynB61h752DAdwG_9zmcbTy8Q&usqp=CAU" style="display: block;
						margin-left: auto;
						margin-right: auto;
						width: 50%; border-radius: 50%; border-style: solid;"><br>
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
						$query11="select t1.jid,t2.jobname,t2.salary FROM  STUD_GETS t1,job t2 WHERE t1.sid={$_SESSION['uid']} and t2.jid=t1.jid ";
						$result11=mysqli_query($con,$query11);
						if($result11 && mysqli_num_rows($result11) > 0)
						{
							echo('<p class="card-text"><b>Placement Status: </b>');
							echo "Placed";
							echo('</p>');
							$queryRow11= $result11->fetch_row();
							echo('<p class="card-text"><b>Job ID: </b>');
							echo $queryRow11[0];
							echo('</p>');
							echo('<p class="card-text"><b>Job Name: </b>');
							echo $queryRow11[1];
							echo('</p>');
							echo('<p class="card-text"><b>Annual Salary: </b>');
							echo $queryRow11[2];
							echo('</p>');
						}
						else{
							echo('<p class="card-text"><b>Placement Status: </b>');
							echo "Not Placed yet";
							echo('</p>');

						}
						?>
						<a href="edit_info.php" class="btn btn-primary" style="background: #390669; color: white;">Edit personal info</a>
					</div>
				</div>

			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>You are eligible to apply for</h3>
				<br>
				<!--<div>
					<button type='button' class='btn btn-info'>Add</button>
				</div>-->
				<br>


				<?php
        #$view1="create view count_req as select jid, count(*) as prereq_count from job_req group by jid";
        #$view2="create or replace view stud_solve_req as select t1.jid, count(*) as courses_sat from job_req t1 join stud_course t2 where t2.sid={$_SESSION['uid']} and t2.courseid=t1.courseid and t2.grade>t1.min_grade group by t1.jid "
				$query="select t2.jid as j,  t3.JOBNAME, t3.role, t3.salary from stud_course t1,job_req t2, job t3 where t1.sid={$_SESSION['uid']} and t2.courseid=t1.courseid and t2.min_grade<=t1.grade and t2.jid=t3.jid group by t2.jid HAVING
				count(*) in(select count(*) as cc from job_req group by jid having jid=j) order by t3.salary desc";
				$result=mysqli_query($con,$query);
				echo "<table id='example' class='display' style='width:100%'>";
				echo "<thead>";
				echo "<tr style='background-color:#e6ccff;'>";
				echo  "<th scope='col'>Job ID</th>";
				echo  "<th scope='col'>Job Name</th>";
				echo  "<th scope='col'>Role</th>";
				echo  "<th scope='col'>Salary</th>";
				echo  "</tr>";
				echo "</thead>";
				$j=0;
				while ($queryRow = $result->fetch_row()) {
					echo "<tr>";
					for($i = 0; $i < $result->field_count; $i++){
						echo "<td>$queryRow[$i]</td>";

					}
					echo "</tr>";
				}
				echo "</table>";
				?>

			</main>
		</div>
	</div>


	<br>
</body>
</html>