<?php
session_start();
include("connection.php");
include("functions.php");
$uid = $_SESSION['uid'];
//fetch user data from database
$query = "select * from student where sid={$uid} limit 1";
$result = mysqli_query($con,$query);
$cont_query = "select phone_no from stud_phone where sid={$uid}";
$cont_res = mysqli_query($con, $cont_query);

if($result){
    $user_data = mysqli_fetch_assoc($result);
    $email = $user_data['EMAIL'];
    $name = $user_data['NAME'];
    $branch = $user_data['BRANCH'];
    $yoa = $user_data['YEAR'];
    $cg = $user_data['CG'];
    $hno = $user_data['HOUSENO'];
    $city = $user_data['CITY'];
    $state = $user_data['STATE'];
    $pin = $user_data['PIN'];
}
else die;
if($_SERVER['REQUEST_METHOD']=="POST")
{   
    //something was posted    
    if(isset($_POST['hno']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pin']) && isset($_POST['submit']))
    {   
        //fetch POSTed data
        $hno=$_POST['hno'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $pin=$_POST['pin'];
        //check if password is correct
        $query="update student set houseno='$hno', city='$city', state='$state', pin='$pin' where sid='$uid' limit 1";
        $result=mysqli_query($con,$query);
        $_SESSION['success'] = "Changes successfully saved";
        header("Location: index.php");
    }
    if(isset($_POST['save_new_cont'])){
            $new = $_POST['new'];
            $new_query = "insert into stud_phone values({$uid}, {$new})";
            mysqli_query($con, $new_query);
            $_SESSION['success'] = "Changes successfully saved";
    }
    if(isset($_POST['del_cont'])){
        $del = $_POST['del'];
        $del_query = "delete from stud_phone where sid={$uid} and phone_no={$del}";
        mysqli_query($con, $del_query);
        $_SESSION['success'] = "Changes successfully saved";
    }
}
?>
<!DOCTYPE html>
<html>
<head>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href='bootstrap/css/bootstrap.css'>
    <link rel="stylesheet" href="assets/css/def.css">
    <title>Student Dasboard</title>
</head>
<style type="text/css">
    .close1{padding:.75rem 1.25rem;color:inherit}
    .close1{float:right;font-size:1.5rem;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;opacity:.5}.close1:focus,.close:hover{color:#000;text-decoration:none;opacity:.75}
    .close1:not(:disabled):not(.disabled){cursor:pointer}
    .close1{padding:0;background-color:transparent;border:0;-webkit-appearance:none}
    .close1{padding:1rem;margin:-1rem -1rem -1rem auto}
    
</style>
<body>

    <header class="navbar navbar-expand navbar-dark flex-column flex-md-row shadow text-light" style="background-color:#7107b8;">
        <a class="navbar-brand" >Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link active-link" href="index.php">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stud_pref.php">Preferences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Eligibility</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </header>
    <div class="container-fluid" style="background: #f9f2ff;">   
        <div class="row flex-xl-nowrap">
            <main role="main" class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 content">
                <h3>Edit Personal Info</h3>
                <div style="color: green;">
                    <?php
                        if(isset($_SESSION['success'])){
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        }
                    ?>
                </div>
                <div>
                    <form method="POST" action="">
                      <fieldset>
                        <div class="form-group row">
                            <label for="name" class="col-1 col-form-label">Name: </label>
                            <input type="text" readonly="" class="col-2 form-control-plaintext" id="name" value="<?=$name ?>">
                        </div>
                        <div class="form-group row">
                            <label for="idno" class="col-2 col-form-label">ID Number: </label>
                              <input type="text" readonly="" class="col-2 form-control-plaintext" id="idno" value="<?=$_SESSION['uid'] ?>">
                            <label for="branch" class="col-2 col-form-label">Branch: </label>
                              <input type="text" readonly="" class="col-2 form-control-plaintext" id="branch" value="<?=$branch ?>">
                        </div>
                        <div class="form-group row">
                            <label for="cg" class="col-2 col-form-label">CGPA: </label>
                                <input type="text" readonly="" class="col-2 form-control-plaintext" id="cg" value="<?=$cg ?>">
                                <label for="yoa" class="col-2 col-form-label">Year of Admission: </label>
                                <input type="text" readonly="" class="col-1 form-control-plaintext" id="yoa" value="<?=$yoa ?>">
                        </div>
                        <div class="form-group">
                          <label for="hno">House no.</label>
                          <input type="number" class=" col-6 form-control" name="hno" id="hno" aria-describedby="emailHelp" value="<?=$hno?>">
                        </div>
                        <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" class=" col-6 form-control" name="city" id="city" value="<?=$city?>">
                        </div>
                        <div class="form-group">
                          <label for="state">State</label>
                          <input type="text" class="col-6 form-control" name="state" id="state" value="<?=$state?>">
                        </div>
                        <div class="form-group">
                          <label for="addr">PIN</label>
                          <input type="number" class="col-6 form-control" name="pin" id="pin" value="<?=$pin?>">
                        </div>
                        <div class="form-group col-4">
                            <span class="col-2">Contact no.s: </span>
                            <br/>
                            <ul class="list-group">
                            <?php
                                $cont_res = mysqli_query($con, $cont_query);
                                while($data = $cont_res->fetch_row()){
                                    echo "<li class='list-group-item'>".$data[0]."</li>";
                                }
                            ?>
                        </ul>
                        <br/>
                        <button type='button' class='m-1 btn btn-info' id='addBtn'>Add Contact</button>
                    <!--modal to add contact-->
                    <div id="addCont" class="modal">
                        <div class="modal-dialog" id="m" role="document">
                            <div class="modal-content" id="mc">
                                <div class="modal-header" id="mh">
                                    <h5 class="modal-title" id='ch'>Add Contact</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="close" id="close1">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="mb">
                                    <form method = "POST" id="f">
                                        <label for="new">New contact: </label>
                                       <input name="new" type="number" id="new" maxlength="10">
                                       <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="save_new_cont">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <script type="text/javascript">
                                var modal1 = document.getElementById("addCont");
                                var btn1 = document.getElementById("addBtn");
                                var span1 = document.getElementById("close1");
                                btn1.onclick = function() {
                                    modal1.style.display = "block";
                                }
                                span1.onclick = function() {
                                    modal1.style.display = "none";
                                }
                                window.onclick = function(event) {
                                    if (event.target == modal1) {
                                        modal1.style.display = "none";
                                    }
                                }
                            </script>
                    </div>
                    <button type='button' class='m-1 btn btn-info' id='delBtn'>Delete Contact</button>
                    <!--modal to delete contact-->
                    <div id="delCont" class="modal" >
                        <div class="modal-dialog" id="m" role="document">
                            <div class="modal-content" id="mc">
                                <div class="modal-header" id="mh">
                                    <h5 class="modal-title" id='ch'>Delete Contact</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="close" id="close2">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="mb">
                                    <form method = "POST" id="f">
                                    <label for="new">Delete contact: </label>
                                    <select name="del" id="del">
                                        <?php
                                            $cont_res = mysqli_query($con, $cont_query);
                                            while($data = $cont_res->fetch_row())
                                                echo "<option value='".$data[0]."'>".$data[0]."</option>";
                                        ?>
                                    </select>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="del_cont">Delete</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            var modal2 = document.getElementById("delCont");
                            var btn2 = document.getElementById("delBtn");
                            var span2 = document.getElementById("close2");
                            btn2.onclick = function() {
                                modal2.style.display = "block";
                            }
                            span2.onclick = function() {
                                modal2.style.display = "none";
                            }
                            window.onclick = function(event) {
                                if (event.target == modal2) {
                                    modal2.style.display = "none";
                                }
                            }
                        </script>
                        </div>
                        </div>
                        <br/>
                        <div class="input-group"> 
                            <br>
                            <button name="submit" class="btn btn-info">Save changes</button>
                            <span class="m-1"><a href="index.php">Back</a></span>
                        </div>
                        </fieldset>
                    </form>
                    <?php
                        
                    ?>
                </div>
            </main>
        </div>
    </div>

</body>
</html>