<?php
    session_start();
    require_once 'pdo.php';
    $_SESSION['name'] = 'ANKITA';
?>
<html>
<head>
    <link rel="stylesheet" href='bootstrap/css/bootstrap.min.css'>
    <link rel="stylesheet" href="assets/css/def.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
    <header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:purple;">
        <h4>Home</h4>
    </header>
    <div class="container-fluid">   
    <div class="row flex-xl-nowrap">
    <div class="col-md-3 col-lg-2 bg-light" id="left-nav-bar" style="padding-left:0; padding-right:0;">
        <div class="card">
          <div class="card-body bg-light">
            <h5 class="card-title">STUDENT PROFILE</h5>
            <?php
              if(isset($_SESSION['name'])){
                $stmt=$pdo->query("SELECT * FROM student WHERE name='".$_SESSION['name']."'");
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
                if($row==true){
                    echo('<p class="card-text">NAME: ');
                    echo(htmlentities($row['name']));
                    echo('</p>');
                    echo('<p class="card-text">ADDRESS: ');
                    echo(htmlentities($row['addr']));
                    echo('</p>');
                }
              else{
            ?>
              <p class="card-text">No such student found</p>
            <?php
              }}
            ?>
            <a href="#" class="btn btn-primary">Edit personal info</a>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active-link" href="#"> Home </a></li>
            <li class="nav-item"><a class="nav-link " href="#"> Preferences </a></li>
            <li class="nav-item"><a class=nav-link href="#"> Eligibility </a></li>
            <li class="nav-item"><a class=nav-link href="#"> Rank </a></li  >
        </ul>
    </div>
    
    <main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
        <h3>Courses Taken</h3>
        <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead>
                <!--insert php here-->
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
              </tbody>
            </table>
        
    </main>
    </div>
    </div>        
</body>