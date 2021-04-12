<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login2($con);
$query="select count(*) FROM  student";
$result=mysqli_query($con,$query);
$queryRow= $result->fetch_row();
$studcount=$queryRow[0];
$query="select count(*) FROM  company";
$result=mysqli_query($con,$query);
$queryRow= $result->fetch_row();
$compcount=$queryRow[0];
$query="select count(*) FROM  job";
$result=mysqli_query($con,$query);
$queryRow= $result->fetch_row();
$jobcount=$queryRow[0];
$query="select count(*) FROM  stud_gets";
$result=mysqli_query($con,$query);
$queryRow= $result->fetch_row();
$plcount=$queryRow[0];
$query="select sum(salary) from stud_gets t1,job t2 where t1.jid=t2.jid";
$result=mysqli_query($con,$query);
$queryRow= $result->fetch_row();
$avsal=$queryRow[0];
$avsal=$avsal/$plcount;
$avsal=round($avsal,2);

$dataPoints = array();
$q="select t2.branch,count(*) from stud_gets t1,student t2 where t1.sid=t2.sid group by t2.branch";
$r=mysqli_query($con,$q);
while ($qr = $r->fetch_row()){
  array_push($dataPoints, array("y"=> $qr[1], "label"=> $qr[0]));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="styles1.css">
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
  <style>
.dropbtn {
  background: #f8f2ff;
  border-radius: 50%;
  padding: 16px;
  font-size: 20px;
  border: none;
}

.dropbtn span{
font-size: 1.5rem;
color: #9141fa
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #ebdbff;}
</style>
</head>
<body>

   <input type="checkbox" id="nav-toggle">
  <div class="sidebar1">
    <div class="sidebar-brand1">
      <h2><span class="lab la-product-hunt"></span><span>Placement Management System</span></h2>
    </div>

    <div class="sidebar-menu1">
      <ul>
        <li >
          <a href="#" class="active1"><span class="las la-home"></span><span>Dashboard</span></a>
        </li>
        <li>
          <a href="admin_student.php"><span class="las la-user-graduate"></span><span>Students</span></a>
        </li>
        <li>
          <a href="admin_courses.php"><span class="las la-school"></span><span>Courses</span></a>
        </li>
        <li>
          <a href="admin_company.php"><span class="las la-industry"></span><span>Companies</span></a>
        </li>
        <li>
          <a href="admin_job.php"><span class="las la-receipt"></span><span>Jobs</span></a>
        </li>
        <li>
          <a href=""><span class="las la-search"></span><span>Query</span></a>
        </li>
         <li>
          <a href=""><span class="las la-plus-circle"></span><span>Add Data</span></a>
        </li>
      </ul>
    </div>
  </div>

  <div class="main-content">
    <header>
      <h2>
        <label for="nav-toggle">
          <span class="las la-bars"></span>
        </label>
      </h2>
      <div class="user-wrapper">
        <div class="dropdown">
          <button class="dropbtn"><span class="las la-power-off"></span></button>
          <div class="dropdown-content">
                    <a href="logout.php"><span>Logout</span></a>
          </div>
        </div>
        <img src="https://thumbs.dreamstime.com/b/solid-purple-gradient-user-icon-web-mobile-design-interface-ui-ux-developer-app-137467998.jpg" width="60px" height="60px" alt="">
        <div>
          <h4>Hello</h4>
          <small>Admin</small>
        </div>
      </div>
    </header>


    <main>

      <div class="cards">
        <div class="card-single">
          <div>
            <?php echo"<h1>$studcount</h1>"?>
            <span>Students</span>
          </div>
          <div>
            <span class="las la-users"></span>
          </div>
        </div>

        <div class="card-single">
          <div>
            <?php echo"<h1>$compcount</h1>"?>
            <span>Companies</span>
          </div>
          <div>
            <span class="las la-industry"></span>
          </div>
        </div>

       <!-- <div class="card-single">
          <div>
            <?php echo"<h1>$jobcount</h1>"?>
            <span>Jobs</span>
          </div>
          <div>
            <span class="las la-receipt"></span>
          </div>
        </div> -->

        <div class="card-single">
          <div>
            <?php echo"<h1>$plcount</h1>"?>
            <span>Students Placed</span>
          </div>
          <div>
            <span class="lab la-google-wallet"></span>
          </div>
        </div>

      <div class="card-single">
          <div>
            <?php echo"<h1>$avsal</h1>"?>
            <span>Average annual income</span>
          </div>
          <div>
            <span class="las la-rupee-sign"></span>
          </div>
        </div>
      </div>

      <div class="recent-grid" >
        <div class="projects">
          <div class="card">
            <div class="card-header">
              <h3>Branch Wise Placement Statistics</h3>
            </div>

            <div class="card-body">
             <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
           </div>
          </div>
        </div>

        <div class="customers">
          <div class="card">
           <div class="card-header">
            <h3>Recently Placed</h3>

            <button>See all<span class="las la-arrow-right"></span></button>
          </div>

          <div class="card-body">
            <?php
            $query1="select t2.sid,t2.name,t3.jobname,t1.pdate from stud_gets t1,student t2,job t3 where t1.sid=t2.sid and t1.jid=t3.jid order by t1.pdate desc limit 5";
            $result1=mysqli_query($con,$query1);
            while ($queryRow1 = $result1->fetch_row()) {
              echo '<div class="customer">';
              echo '<div class="info">';
              echo '<img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/businessman-514-844620.png" width="60px" height="60px" alt="">';
              echo '<div>';
              echo "<h4>$queryRow1[1]</h4>";
              echo "<small>$queryRow1[0]</small>";
              echo '<br>';
              echo "<small>$queryRow1[2]</small>";
              echo '<br>';
              echo "<small>$queryRow1[3]</small>";
              echo '<hr>';
              echo '</div>';
              echo '</div>';
              echo  '</div>';
            }
            ?>

          </div>
        </div>
      </div>
    </div>

  </main>
</div>

</body>
</html>

