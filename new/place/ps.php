<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login1($con);
if(isset($_POST['search'])){
	$_SESSION['jo1']=$_POST['job'];
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
<body style="height: 100vh;">
	
	<header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#1b0075;">
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
					<a class="nav-link active-link" href="#">Selections</a>
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
						<a href="edit_comp_info.php" class="btn btn-primary" style="background-color: #1b0075; color: white;">Edit Profile</a>
					</div>
				</div>
			</div>
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<h3>Students Selected</h3>
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

				<?php if(isset($_SESSION['jo1'])){
					$sql1="select * from job where jid={$_SESSION['jo1']}";
					$result5=mysqli_query($con, $sql1);
					$queryRow1 = $result5->fetch_row();
					echo "<br>";
					echo "<b>";
					echo "Selects for : ";
					echo $queryRow1[0];
					echo " ";
					echo $queryRow1[2];
					echo "</b>";
					$sql1="select t1.sid,t2.name,t2.cg,t2.branch,t1.pdate,t2.houseno,t2.city,t2.state,t2.email from stud_gets t1,student t2 where jid={$_SESSION['jo1']} and t1.sid=t2.sid order by t1.pdate desc";
					$result5=mysqli_query($con, $sql1);
					echo "<table id='example' class='display' style='width:100%'>";
								echo "<thead>";
								echo "<tr style='background-color:#d0c7ff;'>";
								echo  "<th scope='col'>StudentID</th>";  
								echo  "<th scope='col'>Name</th>";
								echo  "<th scope='col'>CG</th>";
								echo  "<th scope='col'>Branch</th>";
								echo  "<th scope='col'>Date Placed</th>";
								echo  "<th scope='col'>Address</th>";
								echo  "<th scope='col'>Email</th>";
								echo  "</tr>";
								echo "</thead>";
								$j=0;
								while ($queryRow = $result5->fetch_row()) {
											echo "<tr>"; 
											echo "<td>$queryRow[0]</td>";
											echo "<td>$queryRow[1]</td>";
											echo "<td>$queryRow[2]</td>";
											echo "<td>$queryRow[3]</td>";
											echo "<td>$queryRow[4]</td>";
											echo "<td>";
											echo "House No: ";
											echo $queryRow[5];
											echo ", ";
											echo $queryRow[6];
											echo ", ";
											echo $queryRow[7];
											echo "</td>";
											echo "<td>$queryRow[8]</td>";
											
											echo "</tr>";}
											$j=$j+1;
										echo "</table>";
				}
				?>

			</main>
		</div>
	</div>


	<br>
</body>
</html>