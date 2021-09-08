<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");
if(!isset($_SESSION["accounttype"]))
{
    $_SESSION["Error"]='Bad Request';
    header("Location:Home.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Style.css">

</head>

<body>
<?php
check_log();
?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="Home.php">
<p style="color:#27aae1;font-weight: bold;">
JOB PORTAL</p></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="col-auto">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="Home.php">Home <span class="sr-only"></span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>
 

                        <?php
                            
                            $admind='<li class="nav-item">'.' <a class="nav-link"'.'href="admin_dashboard.php">Admin Dashboard</a></li>';
                            $employerd='<li class="nav-item">'.' <a class="nav-link"'.'href="employer_view.php">Emloyer Dashboard</a></li>';
                            $seekerd='<li class="nav-item">'.' <a class="nav-link"'.'href="seeker_view.php">Job Seeker Dashboard</a></li>';
                            $ad='<li class="nav-item">'.' <a class="nav-link"'.'href="#">Admin</a></li>';
                            $sup='<li class="nav-item">'.' <a class="nav-link"'.'href="signup.php">SIGN Up</a></li>';
                            if(isset($_SESSION['username']))
                                {   $actype=$_SESSION["accounttype"];
                                    if($actype=="Employer")
                                        {
                                            echo $employerd;
                                        }
                                        else if($actype=="Job Seeker")
                                        {
                                            echo $seekerd;
                                        }
                                        else {
                                            echo $admind;
                                        }
                                }
                                else{

                                    echo $ad;
                                    echo $sup;
                                }
                        
                        ?>
                        <?php
                        $log='<li class="nav-item">'.' <a class="nav-link"'.'href="signin.php">Log IN</a></li>';
                        $log1='<li class="nav-item">'.' <a class="nav-link"'.'href="signout.php">Log Out</a></li>';
                        if(isset($_SESSION['username']))
                        {echo $log1;}
                            else 
                            {
                                echo $log;
                            }   
                        ?>

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <form class="form-inline" action="#">
                            <div class="form-group">
                            <input class="form-control" type="text" name="Search" placehoder="Search Here">
                            <button  class="btn btn-primary" name="Searchbutton">Go</button>

                            </div>
                        </form>
                    </ul>

                </div>
            </div>    
        </div>

    </nav>

    <div class="row">
         <div class="col-lg-12" style="height: 25px;"></div>
    </div>
    <div class="container">
        
            <div>
                <h2 style="text-align:center;">My Profile</h2>
                <?php 

                if(isset($_SESSION['accounttype']))
                {   $actype=$_SESSION["accounttype"];
                        
                    if($actype=="Employer")
                        {   $ID=$_SESSION["empuserid"];
                            $sql="SELECT * FROM employer WHERE id ='$ID'";
                            $folder='employer';
                        }
                        else if($actype=="Job Seeker")
                        {
                            $ID=$_SESSION["seekuserid"];
                            $sql="SELECT * FROM jobseeker WHERE id ='$ID'";
                            $folder='jobseeker';
                        }
                        else if($actype=="Admin")
                        {
                            $ID=$_SESSION["adminid"];
                            $sql="SELECT * FROM admin WHERE id ='$ID'";
                            $folder='admin';
                        }

                }
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) 
                    {
                        while($row = mysqli_fetch_assoc($result)) { 
                            $nam=$row['name'];
                            $email=$row['email'];
                            $pswd=$row['password'];
                            $gen=$row['gender'];
                            $img=$row['image'];
                            $location='upload/'.$folder.'/'.$img;
                            ?>
                             <div class="row">
                                <div class="col-lg-12" style="height: 50px;"></div>
                            </div>
                            <div style='text-align:center'>
                            <img class='rounded' width="300" height="400" src="<?php echo $location;?>">
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12" style="height: 25px;"></div>
                            </div>
                            <div style='width:700px; margin:0 auto'>
                            <table class=" table table-active ">
                                <tr>
                                <td class="table-secondary">Name:</td>
                                <td class="table-secondary"><?php echo $nam;?></td>
                                </tr>
                                <tr>
                                <td class="table-secondary">Email:</td>
                                <td class="table-secondary"><?php echo $email;?></td>
                                </tr>
                                <tr>
                                <td class="table-secondary">Password:</td>
                                <td class="table-secondary"><?php echo $pswd;?></td>
                                </tr>
                                <tr>
                                <td class="table-secondary">Gender:</td>
                                <td class="table-secondary"><?php echo $gen;?></td>
                                </tr>
                                <tr>
                                <td colspan="2"><a href="editprofile.php" ><span class="btn btn-warning btn-lg btn-block">Edit Profile</span></a></td>
                                </tr>
                            </table>
                            </div>
                      <?php  }
                    }
                    
                ?>
               
            </div>
        
    </div>





    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>