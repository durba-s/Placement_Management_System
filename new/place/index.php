<?php
session_start();

include("connection.php");
include("functions.php");
$user_data=check_login($con);
if(isset($_POST['save'])){
	$crs=$_POST['course'];
	$gde=$_POST['grade'];
	$sql = "INSERT INTO STUD_COURSE VALUES ('{$_SESSION['uid']}','$crs','$gde')";
	mysqli_query($con, $sql);
	header("Refresh:0");
}
if(isset($_POST['save1'])){
	$crs1=$_POST['course1'];
	$gde1=$_POST['grade1'];
	$sql1 = "UPDATE STUD_COURSE SET GRADE=".$gde1." where sid={$_SESSION['uid']} and courseid='$crs1'";
	mysqli_query($con, $sql1);
	header("Refresh:0");
}

$dataPoints = array();
$q="select t2.branch,count(*) from stud_gets t1,student t2 where t1.sid=t2.sid group by t2.branch";
$r=mysqli_query($con,$q);
while ($qr = $r->fetch_row()){
	array_push($dataPoints, array("y"=> $qr[1], "label"=> $qr[0]));
}
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="styles1.css">
	<link rel="stylesheet" href='bootstrap/css/bootstrap.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

	<script>
		window.onload = function () {

			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				exportEnabled: true,
  theme: "dark1", // "light1", "light2", "dark1", "dark2"
  data: [{
  	type: "column", 
  	dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
			chart.render();

		}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable( {
				"pagingType": "full_numbers"
			} );
		} );</script>

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

		<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#390669; width: 100%; left: 0px;">
			<a class="navbar-brand" >Dashboard</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link active-link" href="#">Home
						</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="stud_courses.php">Courses</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="stud_pref.php">Preferences</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="stud_elig.php">Eligibility</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="jobquery.php">View Jobs</a>
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
			<main
			style="margin-top: 2px;
			padding: 0.5rem 1rem;
			width: 100%;
			background: #faf5ff;
			min-height: calc(100vh - 2px);">
			<div class="cards">
				<div class="card-single">
					<div>
						<h1>abc</h1>
						<span>Students</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>abc</h1>
						<span>Students</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>abc</h1>
						<span>Students</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>abc</h1>
						<span>Students</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h1>abc</h1>
						<span>Students</span>
					</div>
					<div>
						<span class="las la-users"></span>
					</div>
				</div>
			</div>
			<div class="recent-grid" >
				<div class="projects">
					<div class="card">
						<div class="card-header">
							<h3><b>Branch Wise Placement Statistics</b></h3>
						</div>

						<div class="card-body">
							<div id="chartContainer" style="height: 370px; width: 100%;"></div>
							<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
						</div>
					</div>
				</div>


				<div class="projects">
					<div class="card">
						<div class="card-header">
							<h3><b>Pqrs</b></h3>
						</div>

						<div class="card-body">
							<div id="piechart"></div>
						</div>
					</div>
					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

					<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],
		['Work', 8],
		['Eat', 2],
		['TV', 4],
		['Gym', 2],
		['Sleep', 8]
		]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':300, 'height':370};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>


</div>
</main>
</div>
</div>
<br>

</body>
</html>
