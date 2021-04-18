<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login($con);
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
        } );  
    </script>
    <title>Student Dasboard</title>
</head>

<body style="height: 100vh;">

    <header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#390669;">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- The top dashboard -->
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home
                    </a>
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
                <li class="nav-item active">
                    <a class="nav-link active-link " href="#">Filter Jobs</a>
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
                    <div class="card" style="padding: 1rem; background-color: #b866ff; color: white;height: inherit; width: 230px;">
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
                <h3>Filter Jobs based on</h3>
                <div class="card" style="padding: 1rem; line-height: 1.5rem; border: 1px solid;
                box-shadow: 2px 4px 4px #888888;">
                <form method="POST">
                    <label for='.role.'><b>Role Name  :</b></label>
                    <?php
                    $role = "NULL";
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $role = $_POST['role'];
                    }    
                    echo "<input type=\"text\" name=\"role\" value=\"$role\">";
                    ?>    
                    <br>
                    <br>           
                    <label for=".company."><b>Company Name :</b></label>
                    <?php
                    $company = "NULL";
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $company = $_POST['company'];
                    }    
                    echo "<input type=\"text\" name=\"company\" value=\"$company\">";
                    ?>
                    <br>
                    <br>
                    <label for=".state."><b>State Name :</b></label>
                    <?php
                    $state = "NULL";
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $state = $_POST['state'];
                    }
                    $query = "select distinct state from company";
                    $result = mysqli_query($con,$query);
                    echo "<select name='state' id='state'>";
                    $selector = ($state == "NULL") ? "selected" : "";    
                    echo "<option value=\"NULL\" $selector>------</option>";
                    while ($queryRow = $result->fetch_row()) {
                        $selector = ($state == $queryRow[0]) ? "selected" : "";           
                        echo "<option value=\"$queryRow[0]\" $selector>$queryRow[0]</option>";
                    }
                    echo "</select>";
                    ?>
                    <br>
                    <br>
                    <label for=".city."><b>City Name :</b></label>
                    <?php
                    $city = "NULL";
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $city = $_POST['city'];
                    }   
                    if($state == "NULL") {
                        $query = "select city from company";
                    }
                    else {
                        $query = "select city from company where state=\"$state\"";
                    }
                    $result = mysqli_query($con,$query);
                    echo "<select name='city' id='city'>";
                    $selector = ($city == "NULL") ? "selected" : "";      
                    echo "<option value=\"NULL\">------</option>";
                    while ($queryRow = $result->fetch_row()) {
                        $selector = ($city == $queryRow[0]) ? "selected" : "";
                        echo "<option value=\"$queryRow[0]\" $selector>$queryRow[0]</option>";
                    }
                    echo "</select>";
                    ?>
                    <br>
                    <br>
                    <label for=".salary."><b>Salary :</b></label>
                    <?php
                    $salary = 0;
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $salary = $_POST['salary'];
                    }    
                    echo "<input type=\"number\" name=\"salary\" value=\"$salary\">";
                    ?>
                    <?php
                    $salary_mode = "0";
                    if($_SERVER['REQUEST_METHOD'] == "POST") {
                        $salary_mode = $_POST['salary_mode'];
                    }
                    echo("&nbsp&nbsp");
                    echo "<label for=\".equal.\">Equal </label>";
                    if($salary_mode == "0") {
                        echo "<input type=\"radio\" id=\"equal\" name=\"salary_mode\" value=\"0\" checked> ";
                    }
                    else {
                        echo "<input type=\"radio\" id=\"equal\" name=\"salary_mode\" value=\"0\">";
                    }
                    echo("&nbsp&nbsp");
                    echo "<label for=\".greater.\">Greater </label>";
                    if($salary_mode == "1") {
                        echo "<input type=\"radio\" id=\"greater\" name=\"salary_mode\" value=\"1\" checked> ";
                    }
                    else {
                        echo "<input type=\"radio\" id=\"greater\" name=\"salary_mode\" value=\"1\">";
                    }
                    echo("&nbsp&nbsp");
                    echo "<label for=\".lesser.\">Lesser </label>";
                    if($salary_mode == "2") {
                        echo "<input type=\"radio\" id=\"lesser\" name=\"salary_mode\" value=\"2\" checked> ";
                    }
                    else {
                        echo "<input type=\"radio\" id=\"lesser\" name=\"salary_mode\" value=\"2\"> ";
                    }        
                    ?>    
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary" name="update">Filter</button>  
                </form>  
            </div>
            <br>
            <br>
                <?php
                $query = "select * from job where ";
                if($role != "NULL") {
                    $query = $query."role like '%$role%' and ";
                }
                if($company != "NULL") {
                    $query = $query."jobname like '%$company%' and ";
                }
                if($state != "NULL") {
                    $query = $query."jobname like '%$state%' and ";
                }
                if($city != "NULL") {
                    $query = $query."jobname like '%$city%' and ";
                }
                if($salary != "0") {
                    if($salary_mode == "0") {
                        $query = $query."salary = $salary and ";
                    }
                    else if($salary_mode == "1") {
                        $query = $query."salary > $salary and ";
                    }
                    else if($salary_mode == "2") {
                        $query = $query."salary < $salary and ";
                    }
                }
                $query = substr($query, 0, -4);
                if(substr($query, -1) == "h") {
                    $query = substr($query, 0, -2);
                }
                $result = mysqli_query($con, $query);    
                ?> 

                <table id="example" class="display" style="width:100%">

                    <thead style="background: #e3b0ff;">
                        <tr>
                            <th>Job ID</th>
                            <th>Company ID</th>
                            <th>Job Name</th>
                            <th>Role</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody style="background: #f5edfa;">
                      <?php
                      while ($queryRow = $result->fetch_row()) {
                        echo "<tr>";
                        for($i = 0; $i < $result->field_count; $i++) {
                            echo "<td>$queryRow[$i]</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>       



        </main> 


    </body>
    </html>