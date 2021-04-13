<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login2($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href='bootstrap/css/bootstrap.css'>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="styles1.css">
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
    <script type="text/javascript">
    $(document).ready(function() {
      $('#example1').DataTable( {
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
    <h2><span></span><span>Placement Management System</span></h2>
  </div>

  <div class="sidebar-menu1" >
    <ul>
      <li>
        <a href="index2.php"><span class="las la-home"></span><span>Dashboard</span></a>
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
        <a href="admin_query.php"><span class="las la-search"></span><span>Query</span></a>
      </li>
      <li>
        <a href="#" class="active1"><span class="las la-plus-circle"></span><span>Add Data</span></a>
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

    <h3>Search Details</h3>
    <div>
      <form method = "POST" id="f2">
        <label for='.pre.'>Search details for : </label>
        <select name='role' id='role'>
          <option value="Student">Student</option>
          <option value="Company">Company</option>
          <option value="Job">Job</option>

        </select>
        <label for="new">ID: </label>
        <input name="new" type="number" id="new" required>

        <button type="submit" class="btn btn-primary" name="search" >Search</button>
      </form>
    </div>
    <?php
    if(isset($_POST['search'])){
      echo    '<div class="card" style="padding: 1rem; line-height: 1.5rem;">';
      if($_POST['role']=='Company'){
        $id=$_POST['new'];
        $query = "select * from company where cid={$id} limit 1";
        $result = mysqli_query($con,$query);
        $result1 = mysqli_query($con,$query);


        if($result1->fetch_row()>0){
          $user_data = mysqli_fetch_assoc($result);
          echo '<dl class="row">';
          echo '<dt class="col-sm-3">Company ID:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['CID']}</dd>";
          echo '<dt class="col-sm-3">Name:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['NAME']}</dd>";
          echo '<dt class="col-sm-3">City:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['CITY']}</dd>";
          echo '<dt class="col-sm-3">State:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['STATE']}</dd>";

          $i=1;
          $cont_query = "select contact from comp_cont where cid={$id}";
          $cont_res = mysqli_query($con, $cont_query);
          while($data = $cont_res->fetch_row()){
            echo "<dt class='col-sm-3'>Contact No $i:</dt>";
            echo "<dd class='col-sm-9'>{$data[0]}</dd>";
            $i=$i+1;
          }
          echo '</dl>';
          echo "<b>Jobs Offered</b>";
          $job_query = "select jid,jobname,salary from job where cid={$id}";
          $job_res = mysqli_query($con, $job_query);
          echo "<table id='example' class='display' style='width:100%'>";
          echo "<thead>";
          echo "<tr style='background-color:#d0c7ff;'>";
          echo  "<th scope='col'>Job ID</th>";
          echo  "<th scope='col'>Job Name</th>";
          echo  "<th scope='col'>Annual Salary</th>";
          echo  "</tr>";
          echo "</thead>";
          $j=0;
          while ($queryRow = $job_res->fetch_row()) {
            echo "<tr>";
            for($i = 0; $i < $job_res->field_count; $i++){
              echo "<td>$queryRow[$i]</td>";
            }
            echo "</tr>";
            $j=$j+1;
          }
          echo "</table>";

        }
        else{
          echo "No such company exists";
        }
      }
      else if($_POST['role']=='Student'){
        $id=$_POST['new'];
        $query = "select * from student where sid={$id} limit 1";
        $result = mysqli_query($con,$query);
        $result1 = mysqli_query($con,$query);
        $cont_query = "select phone_no from stud_phone where sid={$id}";
        $cont_res = mysqli_query($con, $cont_query);

        if($result1->fetch_row()>0){
          $user_data = mysqli_fetch_assoc($result);
          echo '<dl class="row">';
          echo '<dt class="col-sm-3">Student ID:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['SID']}</dd>";
          echo '<dt class="col-sm-3">Name:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['NAME']}</dd>";
          echo '<dt class="col-sm-3">Email:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['EMAIL']}</dd>";
          echo '<dt class="col-sm-3">Branch:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['BRANCH']}</dd>";
          echo '<dt class="col-sm-3">Year of admission:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['YEAR']}</dd>";
          echo '<dt class="col-sm-3">CG:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['CG']}</dd>";
          echo '<dt class="col-sm-3">House No:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['HOUSENO']}</dd>";
          echo '<dt class="col-sm-3">City:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['CITY']}</dd>";
          echo '<dt class="col-sm-3">State:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['STATE']}</dd>";
          echo '<dt class="col-sm-3">PIN:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['PIN']}</dd>";
          $i=1;
          $cont_query = "select phone_no from stud_phone where sid={$id}";
          $cont_res = mysqli_query($con, $cont_query);
          $cont_res = mysqli_query($con, $cont_query);
          while($data = $cont_res->fetch_row()){
            echo "<dt class='col-sm-3'>Contact No $i:</dt>";
            echo "<dd class='col-sm-9'>{$data[0]}</dd>";
            $i=$i+1;
          }
          $query11="select t1.jid,t2.jobname,t2.salary FROM  STUD_GETS t1,job t2 WHERE t1.sid={$id} and t2.jid=t1.jid ";
            $result11=mysqli_query($con,$query11);
            if($result11 && mysqli_num_rows($result11) > 0)
            {
              echo '<dt class="col-sm-3">Placement Status:</dt>';
              echo "<dd class='col-sm-9'>Placed</dd>";
              $queryRow11= $result11->fetch_row();
              echo '<dt class="col-sm-3">Job ID:</dt>';
              echo "<dd class='col-sm-9'>{$queryRow11[0]}</dd>";
              echo '<dt class="col-sm-3">Job Name:</dt>';
              echo "<dd class='col-sm-9'>{$queryRow11[1]}</dd>";
              echo '<dt class="col-sm-3">Annual Salary: </dt>';
              echo "<dd class='col-sm-9'>{$queryRow11[2]}</dd>";
            }
            else{
              echo '<dt class="col-sm-3">Placement Status:</dt>';
              echo "<dd class='col-sm-9'>Not Placed</dd>";

            }
          echo '</dl>';


        }
        else{
          echo "No such student exists";
        }

      }
      else {
        $id=$_POST['new'];
        $query = "select * from job where jid={$id} limit 1";
        $result = mysqli_query($con,$query);
        $result1 = mysqli_query($con,$query);


        if($result1->fetch_row()>0){
          $user_data = mysqli_fetch_assoc($result);
          echo '<dl class="row">';
          echo '<dt class="col-sm-3">Job ID:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['JID']}</dd>";
          echo '<dt class="col-sm-3">Name:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['JOBNAME']}</dd>";
          echo '<dt class="col-sm-3">Salary:</dt>';
          echo "<dd class='col-sm-9'>{$user_data['SALARY']}</dd>";

          $i=1;
          $cont_query = "select * from company where cid={$user_data['CID']}";
          $cont_res = mysqli_query($con, $cont_query);
          $cont_data=mysqli_fetch_assoc($cont_res);
          echo '<dt class="col-sm-3">Company ID:</dt>';
          echo "<dd class='col-sm-9'>{$cont_data['CID']}</dd>";
          echo '<dt class="col-sm-3">Company Name:</dt>';
          echo "<dd class='col-sm-9'>{$cont_data['NAME']}</dd>";

          echo '</dl>';
          echo "<b>Prerequisite Courses</b>";
          $sql1="select t1.courseid,t2.name,t2.creds,t1.min_grade from job_req t1,course t2 where jid={$id} and t1.courseid=t2.courseid";
          $result5=mysqli_query($con, $sql1);
          echo "<table id='example' class='display' style='width:100%'>";
          echo "<thead>";
          echo "<tr style='background-color:#d0c7ff;'>";
          echo  "<th scope='col'>CourseID</th>";
          echo  "<th scope='col'>CourseName</th>";
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

          echo "<b>Selects</b>";
          $sql11="select t1.sid,t2.name,t2.cg,t2.branch,t1.pdate,t2.email from stud_gets t1,student t2 where jid={$_SESSION['jo1']} and t1.sid=t2.sid order by t1.pdate desc";
          $result51=mysqli_query($con, $sql11);
          echo "<table id='example1' class='display' style='width:100%'>";
                echo "<thead>";
                echo "<tr style='background-color:#d0c7ff;'>";
                echo  "<th scope='col'>StudentID</th>";
                echo  "<th scope='col'>Name</th>";
                echo  "<th scope='col'>CG</th>";
                echo  "<th scope='col'>Branch</th>";
                echo  "<th scope='col'>Date Placed</th>";
                echo  "<th scope='col'>Email</th>";
                echo  "</tr>";
                echo "</thead>";
                $j=0;
                while ($queryRow1 = $result51->fetch_row()) {
                      echo "<tr>";
                      echo "<td>$queryRow1[0]</td>";
                      echo "<td>$queryRow1[1]</td>";
                      echo "<td>$queryRow1[2]</td>";
                      echo "<td>$queryRow1[3]</td>";
                      echo "<td>$queryRow1[4]</td>";
                      echo "<td>$queryRow1[5]</td>";

                      echo "</tr>";}
                      $j=$j+1;
                    echo "</table>";

        }
        else{
          echo "No such Job exists";
        }
      }
      echo "</div>";
    }
    ?>

  </main>
</div>

</body>
</html>