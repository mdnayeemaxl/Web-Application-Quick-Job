<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Style.css">

</head>
    <body>
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
                            
                            $admind='<li class="nav-item">'.' <a class="nav-link"'.'href="admin_post_view.php">Admin Dashboard</a></li>';
                            $employerd='<li class="nav-item">'.' <a class="nav-link"'.'href="employer_view.php">Emloyer Dashboard</a></li>';
                            $seekerd='<li class="nav-item">'.' <a class="nav-link"'.'href="seeker_view.php">Job Seeker Dashboard</a></li>';
                            $ad='<li class="nav-item">'.' <a class="nav-link"'.'href="adminLogin.php">Admin</a></li>';
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
        
        <div style='   height:100vh;
        width:100%;
        background:url("bge.jpg")no-repeat;
        background-size:cover;
        background-position:center;'>
            <div style='    width:50%;
            background:rgba(0,0,0,.7);
            color:#ffffff;
            text-align: center;
            padding: 50px;
            position: absolute;
            top: 50%;
            left:50%;
            transform: translate(-50%,-50%);'>
                <h1>About Us..</h1>
                <p>
                The Internet is a huge place. It’s extremely active and over 3 billion people use it – for either personal or business use. Social media has taken the world by storm, making it easier to communicate with family and friends, or see what your co-worker was up to last weekend.
Another form of website that is becoming more and more popular in the online community is the job portal. A job portal is a website that bridges the gap between employers and job seekers. Companies can advertise their vacancies and search through applications and CVs of potential employees; candidates can create a profile for themselves with all the necessary information, and search and apply to jobs posted on the site. Also, the website itself is always easy to maneuver around. They are a simple yet effective way to advertise and look for jobs.
This web Application has developed by Md. Nayeem under the instruction of Md. Abdus Satter
                </p>
            </div>
        </div>
        <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>