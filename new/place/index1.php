<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login1($con);

?>

<!DOCTYPE html>
<html>
<head>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<title>Company Dasboard</title>
			  <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">




  <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );</script>
</head>
<body style="height: 100vh;">

	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#1b0075;">
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
					<a class="nav-link" href="jp.php">Job Prerequisites</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="up.php">Update Prerequisites</a>
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
	<div class="container-fluid" style="height:inherit;">
		<div class="row flex-xl-nowrap" style="height: inherit; ">
			<div class="col-md-3 col-lg-2" id="left-nav-bar" style="padding-left:0; padding-right:0;height: inherit; width: 230px; ">
				<div class="card" style="height: inherit; width: 230px;">
					<div class="card" style="padding: 1rem; background-color: #a991ff; color: white;height: inherit; width: 230px;">
						<h5 class="card-title"><b>Company Profile</b></h5>
						<img src="https://www.iconsdb.com/icons/preview/violet/administrator-xxl.png" style="display: block;
						margin-left: auto;
						margin-right: auto;
						width: 50%; border-radius: 50%;
						background: white;
						"><br>
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
						<a href="edit_comp_info.php" class="btn" style="background-color: #1b0075; color: white;">Edit Profile</a>
					</div>
				</div>
			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>Jobs Offered</h3>
				<div>
						<button type='button' class='btn btn-info col-3 m-2' id='myBtn'  >Add Job</button>
					<div id="myModal" class="modal" >
						<div class="modal-dialog" id="m"role="document">
							<div class="modal-content" id="mc">
								<div class="modal-header" id="mh">
									<h5 class="modal-title" id='ch'>Add New Job</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span class="close" >&times;</span>
									</button>
								</div>
									<!--dO NOT BREAK BEFORE THIS-->
								<form method = "POST" id="f">
								<div class="modal-body" id="mb">
									<label for='.cou.'>Job Name  : </label>
									<input type="text" placeholder="Role Name" name="role_name" required>
										<br>
										<label for='.cou.'>Salary  : </label>
										<input type="number" placeholder="Salary" name="salary" required>
									</div>
									<?php
									if($_SERVER['REQUEST_METHOD']=="POST"){
										$role_name=$_POST['role_name'];
										$salary=$_POST['salary'];

										if(!empty($role_name) && !empty($salary)){
											$query421="select * from job";
											$result123=mysqli_query($con, $query421);
											$temp=mysqli_num_rows($result123)+10001;
											$job_name=$user_data['NAME']." - ".$role_name." - ".$user_data['CITY'].", ".$user_data['STATE'];
											$query420="insert into job values($temp, {$_SESSION['uid']}, \"$job_name\", \"$role_name\", $salary)";
											$result=mysqli_query($con,$query420);
												header("Refresh:0");
										}
								}
									?>

									<!--dO NOT BREAK AFTER THIS-->
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
				</div>
				<br>
				<?php
				$query="select t1.jid,t1.jobname,t1.role,t1.salary FROM JOB t1,COMPANY t2 where t1.cid=t2.cid and t1.cid={$_SESSION['uid']}";
				$result=mysqli_query($con,$query);
				echo "<table id='example' class='display' style='width:100%'>";
				echo "<thead>";
				echo "<tr style='background-color:#d0c7ff;'>";
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
