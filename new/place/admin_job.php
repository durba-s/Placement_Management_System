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
          <a href="#" class="active1"><span class="las la-receipt"></span><span>Jobs</span></a>
        </li>
        <li>
          <a href="admin_query.php"><span class="las la-search"></span><span>Query</span></a>
        </li>
         <li>
          <a href="admin_add.php"><span class="las la-plus-circle"></span><span>Add Data</span></a>
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

      <table id="example" class="display" style="width:100%">

        <thead style="background: #e3b0ff;">
            <tr>
                <th>Job ID</th>
                <th>Job Name</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody style="background: #f5edfa;">
          <?php
          $query1="select jid,jobname,salary from job";
          $result1=mysqli_query($con,$query1);
          while ($queryRow1 = $result1->fetch_row()) {
            echo "<tr>";
            for($i = 0; $i < $result1->field_count; $i++){
                echo "<td>$queryRow1[$i]</td>";
              }
              echo "</tr>";
            }
          ?>
        </tbody>
    </table>
      
  </main>
</div>

</body>
</html>