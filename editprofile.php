<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");

if(!isset($_SESSION["accounttype"]))
{
    $_SESSION["Error"]='Bad Request';
    header("Location:Home.php");
    
}
?>
<?php
$ename="";
$eemail="";
$epass="";
$c4=0;
$c1=0;
$c2=0;

if(isset($_POST["Submit"]))
    {   $pname=$_POST["name"];

        $pemail=$_POST["email"];
        $ppass=$_POST["pass"];
        $gender=$_POST["gender"];
        $Image=$_FILES["image"]["name"] ;
        $actype=$_SESSION["accounttype"];
        if($actype=="Employer")
        { 
            $Target="upload/employer/".basename($_FILES["image"]["name"]);
        }
        else if($actype=="Job Seeker")
        {    
            $Target="upload/jobseeker/".basename($_FILES["image"]["name"]);
        }
        else if($actype=="Admin")
        {
            $Target="upload/admin/".basename($_FILES["image"]["name"]);
            
        }
        
        
        if(empty($pname)){
            $ename='<div class="alert alert-danger">Name is Required</div></br>';
        }
        else {
                if(!preg_match("/^[A-Za-z. ]*$/",$pname))
                {
                    $ename='<div class="alert alert-danger">Only Letters and white space are Required</div></br>';
                }
                else $c1=1;
            }

            if(empty($pemail)){
                $eemail='<div class="alert alert-danger">Email is Required</div></br>';
            }
            else {
                    if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$pemail))
                    {
                        $eemail='<div class="alert alert-danger">Please provide valid email Address</div></br>';
                    }
                    else $c2=1;
                }
                if(empty($ppass))
                {
                    $epass='<div class="alert alert-danger">Password is required</div></br>';
                }
            else{
                    if(strlen($ppass)<8)
                        {
                            $epass='<div class="alert alert-danger">Password length should be greater than 8 character</div></br>';
                        }
                        else $c4=1;
                }
        
        
    
                if(!empty($pname)&&!empty($pemail)&&!empty($ppass) && ($c1==1)&& ($c2==1)&& ($c4==1)){

            if(isset($_SESSION['accounttype']))
            {   $actype=$_SESSION["accounttype"];
                    
                if($actype=="Employer")
                    {   $ID=$_SESSION["empuserid"];
                        
                        if(!empty($_FILES["image"]["name"])) {
                            $sql="UPDATE employer SET name='$pname',email='$pemail',image='$Image',password='$ppass',gender='$gender' WHERE id='$ID'";
                            }
                            else $sql="UPDATE employer SET name='$pname',email='$pemail',password='$ppass',gender='$gender' WHERE id='$ID'";
                        
                    }
                    else if($actype=="Job Seeker")
                    {
                        $ID=$_SESSION["seekuserid"];
                        if(!empty($_FILES["image"]["name"])) {
                            $sql="UPDATE jobseeker SET name='$pname',email='$pemail',image='$Image',password='$ppass',gender='$gender' WHERE id='$ID'";
                            }
                            else $sql="UPDATE jobseeker SET name='$pname',email='$pemail',password='$ppass',gender='$gender' WHERE id='$ID'";
                        
                    }
                    else if($actype=="Admin")
                    {
                        $ID=$_SESSION["adminid"];
                        if(!empty($_FILES["image"]["name"])) {
                            $sql="UPDATE admin SET name='$pname',email='$pemail',image='$Image',password='$ppass',gender='$gender' WHERE id='$ID'";
                            }
                            else $sql="UPDATE admin SET name='$pname',email='$pemail',password='$ppass',gender='$gender' WHERE id='$ID'";
                        
                    }

            }

           
           
           if (mysqli_query($conn, $sql)) {
                move_uploaded_file($_FILES["image"]["tmp_name"],$Target);  
                $_SESSION["success"]="Profile has Updated Success fully "; 
                            
                header("Location:employer_view.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
        }
       
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Style.css">
	<title>Job Categories </title>

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
	
	<section class ="container py-2 mb-4">
		<div class="row" >
			<div class="offset-lg-1 col-lg-10" >
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

                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) 
                            {
                                $nam=$row['name'];
                                $email=$row['email'];
                                $pswd=$row['password'];
                                $gen=$row['gender'];
                                $img=$row['image'];

                             }
                    } 
                    
                    else {
                        echo "0 results";
                    }

                    


                ?>
				<form class="" action="editprofile.php" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Update Profile</h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="nam"> <span style="color:rgb(0, 153, 153) ">Name</span></label>
								<input class ="form-control" type="text" name="name" id="nam" placeholder="Name" value="<?php echo $nam; ?>"> <?php echo $ename; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="Email"> <span style="color:rgb(0, 153, 153) ">Email</span></label>
								<input class ="form-control" type="text" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>"> <?php echo $eemail; ?>
                            </div>

                            <div class="form-group">
								<label for="pass"> <span style="color:rgb(0, 153, 153) ">Password</span></label>
								<input class ="form-control" type="text" name="pass" id="pass" placeholder="Password" value="<?php echo $pswd; ?>"> <?php echo $epass; ?>
                            </div>

                            <div class="form-group">
								<label for="Gender"> <span class="FieldInfo"style="color:rgb(0, 153, 153)">Gender</span></label>
								<select class="form-control" id="Gender" name="gender"><?php echo $gen; ?>
                                        <option>Male</option> 
                                        <option>Female</option> 
                                </select>
                            </div>
                      
                            <div class="form-group">
                                <label for="imageSelect"> <span style="FieldInfo; color:rgb(0, 153, 153);"> Select Image</span></label>
                                    <div class="custom-file">
                                        <input class ="custom-file-input" type="File" name="image" id="imageSelect" > 
                                        <label for="imageSelect" class="custom-file-label"> </label>
                                    </div>
                            </div>


                            
                            <div class="row">
								<div class="col-lg-12">
									<button type="Submit" name="Submit" class="btn btn-success btn-block">
										Update
									</button>
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	
	</section>
    
    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>