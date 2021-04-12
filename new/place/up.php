<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login1($con);
if(isset($_POST['search'])){
	$_SESSION['jo']=$_POST['job'];
	header("Refresh:0");

}
if(isset($_POST['save'])){
	$crs=$_POST['course'];
	$gde=$_POST['grade'];
	$sql = "INSERT INTO JOB_REQ VALUES ('{$_SESSION['jo']}','$crs','$gde')";
	mysqli_query($con, $sql);
	header("Refresh:0");
}
if(isset($_POST['save1'])){
	$crs1=$_POST['course1'];
	$gde1=$_POST['grade1'];
	$sql1 = "UPDATE JOB_REQ SET MIN_GRADE=".$gde1." where jid={$_SESSION['jo']} and courseid='$crs1'";
	mysqli_query($con, $sql1);
	header("Refresh:0");
}
if(isset($_POST['save2'])){
	$crs1=$_POST['course1'];
	$gde1=$_POST['grade1'];
	$sql1 = "DELETE FROM JOB_REQ WHERE jid={$_SESSION['jo']} and courseid='$crs1'";
	mysqli_query($con, $sql1);
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
				<li class="nav-item">
					<a class="nav-link" href="jp.php">Job Prerequisites</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link active-link" href="#">Update Prerequisites</a>
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
					<div class="card" style="padding: 1rem;">
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
						<a href="edit_comp_info.php" class="btn btn-primary">Edit personal info</a>
					</div>
				</div>
			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>Update/Add Pre-Requisites</h3>
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
        <!--ADDING A PREREQ-->
				<button type="submit" class="btn btn-primary" name="search">Search</button>
        <br>
        <button type='button' class='btn btn-info col-3 m-3' id='gBtn' >Add Pre-Requisite</button>
        <div id="myModal1" class="modal" >
          <div class="modal-dialog" id="m1"role="document">
            <div class="modal-content" id="mc1">
              <div class="modal-header" id="mh1">
                <h5 class="modal-title" id='ch1'>Add Pre-Requisite</h5>
                <button type="button" class="close1" data-dismiss="modal" aria-label="Close" >
                  <span class="close1" >&times;</span>
                </button>
              </div>
              <form method = "POST" id="f1">
              <div class="modal-body" id="mb1">
                  <?php
                  echo "<label for='.cou.'>Course Name  : </label>";
                  $sql1 = "select * from course where courseid not in(select courseid from job_req where jid={$_SESSION['jo']}) order by name asc";
                  $result5=mysqli_query($con, $sql1);
                  echo "<select name='course' id='course'>";
                  while ($queryRow1= $result5->fetch_row()) {
                    echo '<option value="'.$queryRow1[0].'">'.$queryRow1[1].'</option>';
                  }
                  echo "</select>";
                  ?>
                  <br>
                  <?php
                  echo "<label for='.gra.'>Grade  : </label>";
                  echo "<select name='grade' id='grade'>";
                  for($gr1=4;$gr1<=10;$gr1++){
                    echo '<option value="'.$gr1.'">'.$gr1.'</option>';
                  }
                  echo "</select>";

                  ?>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="save">Save changes</button>
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

        <button type='button' class='btn btn-info col-3 m-3' id='iBtn' >Delete Pre-Requisite</button>
        <div id="myModal111" class="modal" >
          <div class="modal-dialog" id="m111"role="document">
            <div class="modal-content" id="mc111">
              <div class="modal-header" id="mh111">
                <h5 class="modal-title" id='ch111'>Delete Pre-Requisite Course</h5>
                <button type="button" class="close111" data-dismiss="modal" aria-label="Close" >
                  <span class="close111" >&times;</span>
                </button>
              </div>
              <form method = "POST" id="f111">
              <div class="modal-body" id="mb111">
                  <?php
                  echo "<label for='.cou.'>Course Name  : </label>";
                  $sql1="select t1.courseid,t2.name,t2.creds,t1.min_grade from job_req t1,course t2 where jid={$_SESSION['jo']} and t1.courseid=t2.courseid order by t2.name asc";
                  $result5=mysqli_query($con, $sql1);
                  echo "<select name='course1' id='course1'>";
                  while ($queryRow1= $result5->fetch_row()) {
                    echo '<option value="'.$queryRow1[0].'">'.$queryRow1[1].'</option>';
                  }
                  echo "</select>";
                  ?>
                  <br>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="save2">Save changes</button>
                  <script type="text/javascript">
                    var modal2 = document.getElementById("myModal111");
                    var btn2= document.getElementById("iBtn");
                    var span2 = document.getElementsByClassName("close111")[0];
                    btn2.onclick = function() {
                      modal2.style.display = "block";
                    }
                    span2.onclick = function() {
                      modal2.style.display = "none";
                    }
                    window.onclick = function(event) {
                      if (event.target == modal) {
                        modal2.style.display = "none";
                      }
                    }
                  </script>
                </div>
              </form>

            </div>
          </div>
        </div>



        <button type='button' class='btn btn-info col-3 m-3' id='hBtn' >Edit Required Grade</button>
        <div id="myModal11" class="modal" >
          <div class="modal-dialog" id="m11"role="document">
            <div class="modal-content" id="mc11">
              <div class="modal-header" id="mh11">
                <h5 class="modal-title" id='ch11'>Edit Course Grade</h5>
                <button type="button" class="close11" data-dismiss="modal" aria-label="Close" >
                  <span class="close11" >&times;</span>
                </button>
              </div>
              <form method = "POST" id="f11">
              <div class="modal-body" id="mb11">
                  <?php
                  echo "<label for='.cou.'>Course Name  : </label>";
                  $sql1="select t1.courseid,t2.name,t2.creds,t1.min_grade from job_req t1,course t2 where jid={$_SESSION['jo']} and t1.courseid=t2.courseid order by t2.name asc";
                  $result5=mysqli_query($con, $sql1);
                  echo "<select name='course1' id='course1'>";
                  while ($queryRow1= $result5->fetch_row()) {
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
                    var modal2 = document.getElementById("myModal11");
                    var btn2= document.getElementById("hBtn");
                    var span2 = document.getElementsByClassName("close11")[0];
                    btn2.onclick = function() {
                      modal2.style.display = "block";
                    }
                    span2.onclick = function() {
                      modal2.style.display = "none";
                    }
                    window.onclick = function(event) {
                      if (event.target == modal) {
                        modal2.style.display = "none";
                      }
                    }
                  </script>
                </div>
              </form>

            </div>
          </div>
        </div>
        <br>
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
					echo "<table id='example' class='display' style='width:100%'>";
								echo "<thead>";
								echo "<tr style='background-color:#96b8ff;'>";
								echo  "<th scope='col'>Course ID</th>";
								echo  "<th scope='col'>Course Name</th>";
								echo  "<th scope='col'>Credits</th>";
								echo  "<th scope='col'>Min Grade</th>";
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
				}
				?>

			</main>
		</div>
	</div>


	<br>
</body>
</html>
