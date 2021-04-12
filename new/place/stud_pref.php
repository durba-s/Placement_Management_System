<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);
if(isset($_POST['save'])){
	$pjob=$_POST['job'];
	$sql = "INSERT INTO STUD_WANTS VALUES ('{$_SESSION['uid']}','$pjob')";
	mysqli_query($con, $sql);
	header("Refresh:0");
}
if(isset($_POST['save1'])){
	$rejob=$_POST['rjob'];
	$sql = "DELETE FROM STUD_WANTS WHERE sid='{$_SESSION['uid']}' and jid='$rejob' ";
	mysqli_query($con, $sql);
	header("Refresh:0");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href='bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="assets/css/def.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
				<li class="nav-item active">
					<a class="nav-link active-link " href="#">Preferences</a>
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
						?>
						<a href="edit_info.php" class="btn btn-primary" style="background: #390669; color: white;">Edit personal info</a>
					</div>
				</div>

			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>My Job Preferences</h3>
				<br>
				<div class="row">
					<button type='button' class='btn btn-info col-3 m-2' id='myBtn' >Add Job Preference</button>
					<div id="myModal" class="modal" >
						<div class="modal-dialog modal-lg" id="m"role="document">
							<div class="modal-content" id="mc">
								<div class="modal-header" id="mh">
									<h5 class="modal-title" id='ch'>Add Job Preference</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span class="close" >&times;</span>
									</button>
								</div>
								<form method = "POST" id="f">
                                    <div class="modal-body" id="mb">
										<?php
                                            echo "<label for='.pref.'>Job Name : </label>";
                                            $query = "select jid,jobname from job where jid not in(select jid from stud_wants where sid={$_SESSION['uid']}) order by jobname asc";
                                            $result=mysqli_query($con,$query);
                                            echo "<select name='job' id='job'>";
                                            while ($queryRow = $result->fetch_row()) {
                                                echo '<option value="'.$queryRow[0].'">'.$queryRow[1].'</option>';
                                            }
                                            echo "</select>";

										?>
                                    </div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="save">Save changes</button>
									</div>
								</form>
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
					<button type='button' class='btn btn-info col-1 m-2' id='gBtn'>Delete</button>
					<div id="myModal1" class="modal" >
						<div class="modal-dialog modal-lg" id="m1"role="document">
							<div class="modal-content" id="mc1">
								<div class="modal-header" id="mh1">
									<h5 class="modal-title" id='ch1'>Delete Preference</h5>
									<button type="button" class="close1" data-dismiss="modal" aria-label="Close" >
										<span class="close1" >&times;</span>
									</button>
								</div>
								<div class="modal-body" id="mb1">
									<form method = "POST" id="f1">
										<?php
                                            echo "<label for='.djob.'>Job Name  : </label>";
                                            $query1 = "select jid,jobname from job where jid in(select jid from stud_wants where sid={$_SESSION['uid']}) order by jobname asc";
                                            $result1=mysqli_query($con,$query1);
                                            echo "<select name='rjob' id='rjob'>";
                                            while ($queryRow1= $result1->fetch_row()) {
                                                echo '<option value="'.$queryRow1[0].'">'.$queryRow1[1].'</option>';
                                            }
                                            echo "</select>";
										?>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="save1">Delete</button>
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
			     </div>
				<br>
				<?php
                    $query="select t1.jid,t3.jobname,t3.salary from stud_wants t1,job t3 where t1.jid=t3.jid and t1.sid={$_SESSION['uid']} order by t3.jobname asc";
                    $result=mysqli_query($con,$query);
                    echo "<table id='example' class='table' style='width:100%'>";
                    echo "<thead>";
                    echo "<tr style='background-color:#e6ccff;'>";
                    echo  "<th scope='col'>Job ID</th>";
                    echo  "<th scope='col'>Job Name</th>";
                    echo  "<th scope='col'>Salary</th>";
                    echo  "</tr>";
                    echo "</thead>";
                    $j=0;
                    while ($queryRow = $result->fetch_row()) {
                        echo "<tr>";
                        for($i = 0; $i < $result->field_count; $i++){
                            echo "<td>$queryRow[$i]</td>";

                        }
                        echo "<td><button type='button' class='btn btn-primary picked' id='{$queryRow[0]}'>View Details</button></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
				?>
                <div id="reqModal" class="modal" >
						<div class="modal-dialog modal-lg" id="req" role="document">
							<div class="modal-content" id="reqc">
								<div class="modal-header" id="mh">
									<h5 class="modal-title" id='ch'>Job Details</h5>
									<button type="button" class="reqClose btn close" data-dismiss="modal" aria-label="Close">
										<span class="reqClose" >&times;</span>
									</button>
								</div>
								<div class="modal-body" id="reqb"></div>
						      </div>
						<script type="text/javascript">
							var reqModal = document.getElementById('reqModal');
							var reqModalClose = document.getElementsByClassName("reqClose")[0];
                            $('.picked').on('click', function() {
                                console.log(this.id);
                                jid = this.id;
                                $('#reqb').load('view_prereq.php?jid='+jid,function(){
                                    reqModal.style.display = "block";
                                });
                            });
							reqModalClose.onclick = function() {
								reqModal.style.display = "none";
							}
							window.onclick = function(event) {
								if (event.target == modal) {
									reqModal.style.display = "none";
								}
							}
						</script>
					   </div>
				    </div>
            </main>
		</div>
	</div>
	<br>
</body>
</html>
