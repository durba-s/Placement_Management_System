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

		<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#390669;">
			<a class="navbar-brand" >Dashboard</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home
						</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link active-link" href="stud_courses.php">Courses</a>
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
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>Courses Taken</h3>
				<br>
				<div class="row">

					<button type='button' class='btn btn-info col-3 m-2' id='myBtn'  <?php if($result11->num_rows>0) {?> disabled="disabled" <?php } ?> >Add Course</button>
					<div id="myModal" class="modal" >
						<div class="modal-dialog" id="m"role="document">
							<div class="modal-content" id="mc">
								<div class="modal-header" id="mh">
									<h5 class="modal-title" id='ch'>Add Courses</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span class="close" >&times;</span>
									</button>
								</div>

								<form method = "POST" id="f">
								<div class="modal-body" id="mb">
										<?php
										echo "<label for='.cou.'>Course Name  : </label>";
										$query = "select * from course where courseid not in(select courseid from stud_course where sid={$_SESSION['uid']}) order by name asc";
										$result=mysqli_query($con,$query);
										echo "<select name='course' id='course'>";
										while ($queryRow = $result->fetch_row()) {
											echo '<option value="'.$queryRow[0].'">'.$queryRow[1].'</option>';
										}
										echo "</select>";
										?>
										<br>
										<?php
										echo "<label for='.gra.'>Grade  : </label>";
										echo "<select name='grade' id='grade'>";
										for($gr=4;$gr<=10;$gr++){
											echo '<option value="'.$gr.'">'.$gr.'</option>';
										}
										echo "</select>";

										?>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="save">Save changes</button>
									</div>
								</form>

							</div>
						</div>
						<script type="text/javascript">
							var modal = document.getElementById("myModal");
							var btn = document.getElementById("myBtn");
							var span = document.getElementsByClassName("close")[0];
							btn.onclick = function() {
								modal.style.display = "block";
							}
							span.onclick = function() {
								modal.style.display = "none";
							}
							window.onclick = function(event) {
								if (event.target == modal) {
									modal.style.display = "none";
								}
							}
						</script>

					</div>
					<button type='button' class='btn btn-info col-2 m-2' id='gBtn' <?php if($result11->num_rows>0) {?> disabled="disabled" <?php } ?>>Edit Grade</button>
					<div id="myModal1" class="modal" >
						<div class="modal-dialog" id="m1"role="document">
							<div class="modal-content" id="mc1">
								<div class="modal-header" id="mh1">
									<h5 class="modal-title" id='ch1'>Edit Course Grade</h5>
									<button type="button" class="close1" data-dismiss="modal" aria-label="Close" >
										<span class="close1" >&times;</span>
									</button>
								</div>

								<form method = "POST" id="f1">
								<div class="modal-body" id="mb1">
										<?php
										echo "<label for='.cou.'>Course Name  : </label>";
										$query1 = "select * from course where courseid in(select courseid from stud_course where sid={$_SESSION['uid']}) order by name asc";
										$result1=mysqli_query($con,$query1);
										echo "<select name='course1' id='course1'>";
										while ($queryRow1= $result1->fetch_row()) {
											echo '<option value="'.$queryRow1[0].'">'.$queryRow1[1].'</option>';
										}
										echo "</select>";
										?>
										<br>
										<?php
										echo "<label for='.gra.'>Grade  : </label>";
										echo "<select name='grade1' id='grade1'>";
										for($gr1=4;$gr1<=10;$gr1++){
											echo '<option value="'.$gr1.'">'.$gr1.'</option>';
										}
										echo "</select>";

										?>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="save1">Save changes</button>
										<script type="text/javascript">
											var modal1 = document.getElementById("myModal1");
											var btn1= document.getElementById("gBtn");
											var span1 = document.getElementsByClassName("close1")[0];
											btn1.onclick = function() {
												modal1.style.display = "block";
											}
											span1.onclick = function() {
												modal1.style.display = "none";
											}
											window.onclick = function(event) {
												if (event.target == modal) {
													modal.style.display = "none";
												}
											}
										</script>
									</div>
								</form>

							</div>
						</div>


					</div>
				</div>

				<br>
				<div>
					<?php
					$query5="select c.courseid,c.name,c.creds,t1.grade from stud_course t1,student t2,course c where t1.sid=t2.sid and c.courseid=t1.courseid and t2.sid={$_SESSION['uid']} order by c.name asc";
					$result5=mysqli_query($con,$query5);
					echo "<table id='example' class='display' style='width:100%'>";
					echo "<thead>";
					echo "<tr style='background-color:#e6ccff;'>";
					echo  "<th scope='col'>CourseID</th>";
					echo  "<th scope='col'>CourseName</th>";
					echo  "<th scope='col'>Credits</th>";
					echo  "<th scope='col'>Grade</th>";
					echo  "</tr>";
					echo "</thead>";
					$j=0;
					while ($queryRow = $result5->fetch_row()) {

						echo "<tr>";
						for($i = 0; $i < $result5->field_count; $i++){
							echo "<td>$queryRow[$i]</td>";
						}
						echo "</tr>";
						$j=$j+1;
					}
					echo "</table>";
					?>

				</div>
			</main>
		</div>
	</div>
	<br>

</body>
</html>