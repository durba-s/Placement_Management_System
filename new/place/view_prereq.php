<?php
session_start();
 
include("connection.php");
include("functions.php");
 
$user_data=check_login($con);

$uid = $_SESSION['uid'];
$jid = $_GET['jid'];
 
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
 
 
 
 
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable( {
				"pagingType": "full_numbers"
			} );
		} );  
	</script>
	<title>Student Dashboard</title>
</head>
<body>
	<div class="container-fluid">   
		<div class="row flex-xl-nowrap">
			<main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
				<?php
				$query="select * from job t1,company t2 where jid = {$jid} and t1.cid=t2.cid";
				 $result=mysqli_query($con,$query);
				 $data = $result->fetch_row();
				 echo "<p>";
				 echo "<b>Job ID- </b>";
				 echo "$data[0]";
				 echo "</p>";
				 echo "<p>";
				 echo "<b>Job Name- </b>";
				 echo "$data[2]";
				 echo "</p>";
				 echo "<p>";
				 echo "<b>Annual Salary- </b>Rs";
				 echo "$data[4]";
				 echo "</p>";
				 echo "<p>";
				 echo "<b>Company ID- </b>";
				 echo "$data[0]";
				 echo "</p>";
				 echo "<p>";
				 echo "<b>Company Name- </b>";
				 echo "$data[6]";
				 echo "</p>";
				 echo "<p>";
				 echo "<b>Company Location- </b>";
				 echo "$data[7], $data[8]";
				 echo "</p>";

				?>
				<p><b>Job Prerequisites- </b></p>
                <table class="table">
                <thead>
                    <tr style="background-color:#f8edff;">
                    <th scope="col">#</th>
                    <th scope="col">Course ID</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Min Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;
                        $query="select jr.courseid, c.name, jr.min_grade from job_req jr, course c where c.courseid = jr.courseid and jid = {$jid} order by jr.courseid asc";
				        $result=mysqli_query($con,$query);
                        while($data = $result->fetch_row()){
                            echo "<tr><th scope='row'>{$i}</th><td>".$data[0]."</td><td>".$data[1]."</td><td>".$data[2]."</td></tr>";
                            $i=$i+1;
                        }
                    ?>
                </tbody>
                </table>
			</main>
		</div>
	</div>
 
 
	<br>
</body>
</html>