
<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>

<?php
$ename="";
$eemail="";
$epass="";
$ecpass="";
$egender="";
$edob="";
$etype="";
$img="";
if(isset($_POST["Submit"]))
    {
        $fname=$_POST["name"];
        $mail=$_POST["email"];
        $password=$_POST["pass"];
        $cpassword=$_POST["cpass"];
        $gen=$_POST["gender"];
        $date=$_POST["date"];
        $act=$_POST["accounttype"];
        $Image=$_FILES["image"]["name"];
        
        $c1=0;
        $c2=0;
        $c3=0;
        $c4=0;

         if($act=='Employer')

        {   
            $sql="SELECT * FROM employer WHERE email='$mail'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) 
                {
                    $_SESSION["Error"]="Email Already Exist. Please use another email to sign up ";  
                               //17
                    header("Location:signup.php");
                    //mysqli_close($conn); 
                }
            else{

                $Target="upload/employer/".basename($_FILES["image"]["name"]);

                if(empty($fname)){
                    $ename='<div class="alert alert-danger">Name is Required</div></br>';
                }
                else {
                        if(!preg_match("/^[A-Za-z. ]*$/",$fname))
                        {
                            $ename='<div class="alert alert-danger">Only Letters and white space are Required</div></br>';
                        }
                        else $c1=1;
                    }
        
                    if(empty($mail)){
                        $eemail='<div class="alert alert-danger">Email is Required</div></br>';
                    }
                    else {
                            if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$mail))
                            {
                                $eemail='<div class="alert alert-danger">Please provide valid email Address</div></br>';
                            }
                            else $c2=1;
                        }
                    if(empty($password))
                        {
                            $epass='<div class="alert alert-danger">Password is required</div></br>';
                        }
                    else{
                            if(strlen($password)<8)
                                {
                                    $epass='<div class="alert alert-danger">Password length should be greater than 8 character</div></br>';
                                }
                                else $c4=1;
                        }
                        if(empty($cpassword))
                            {
                                $ecpass='<div class="alert alert-danger">Confirm your Password </div></br>';
                            }
                        else{
                                if($password!=$cpassword)
                                    {
                                        $ecpass='<div class="alert alert-danger">Confirm Password should match Password Fild Input</div></br>';
                                    }
                                else $c3=1;
                            }
                        if(empty($date))
                            {
                                $edob='<div class="alert alert-danger">Date of Birth Required</div></br>';
                            }
                if(!empty($fname)&&!empty($mail)&&!empty($password)&&!empty($cpassword)&&!empty($date) && ($c1==1)&& ($c2==1)&& ($c3==1)&& ($c4==1))
                    {

                                $sql="INSERT INTO employer (name,email,password,dob,gender,image) VALUES ('$fname','$mail','$password','$date','$gen','$Image') ";
                            if (mysqli_query($conn, $sql)) {
                                move_uploaded_file($_FILES["image"]["tmp_name"],$Target); 
                                $_SESSION["success"]="Sign up has Successfully Completed";              //focus on this line
                                header("location:signin.php");                                      ////////////////////////////////////////
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                            mysqli_close($conn);
                    }

                }
        }
     else
        {
            $sql="SELECT * FROM jobseeker WHERE email='$mail'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                $_SESSION["Error"]="Email Already Exist. Please use another email to sign up "; 
                          //17
                header("Location:signup.php");
               // mysqli_close($conn); 
            }
            else
            {   $Target="upload/jobseeker/".basename($_FILES["image"]["name"]);
                if(empty($fname)){
                    $ename='<div class="alert alert-danger">Name is Required</div></br>';
                }
                else {
                        if(!preg_match("/^[A-Za-z. ]*$/",$fname))
                        {
                            $ename='<div class="alert alert-danger">Only Letters and white space are Required</div></br>';
                        }
                        else $c1=1;
                    }
        
                    if(empty($mail)){
                        $eemail='<div class="alert alert-danger">Email is Required</div></br>';
                    }
                    else {
                            if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$mail))
                            {
                                $eemail='<div class="alert alert-danger">Please provide valid email Address</div></br>';
                            }
                            else $c2=1;
                        }
                    if(empty($password))
                        {
                            $epass='<div class="alert alert-danger">Password is required</div></br>';
                        }
                    else{
                            if(strlen($password)<8)
                                {
                                    $epass='<div class="alert alert-danger">Password length should be greater than 8 character</div></br>';
                                }
                                else $c4=1;
                        }
                        if(empty($cpassword))
                            {
                                $ecpass='<div class="alert alert-danger">Confirm your Password </div></br>';
                            }
                        else{
                                if($password!=$cpassword)
                                    {
                                        $ecpass='<div class="alert alert-danger">Confirm Password should match Password Fild Input</div></br>';
                                    }
                                else $c3=1;
                            }
                        if(empty($date))
                            {
                                $edob='<div class="alert alert-danger">Date of Birth Required</div></br>';
                            }
                if(!empty($fname)&&!empty($mail)&&!empty($password)&&!empty($cpassword)&&!empty($date) && ($c1==1)&& ($c2==1)&& ($c3==1)&& ($c4==1))
                    {
                                $sql="INSERT INTO jobseeker (name,email,password,dob,gender,image) VALUES ('$fname','$mail','$password','$date','$gen','$Image') ";
                            if (mysqli_query($conn, $sql)) {
                                move_uploaded_file($_FILES["image"]["tmp_name"],$Target); 
                                $_SESSION["success"]="Sign up has Successfully Completed";              //focus on this line
                                header("location:signin.php");                                      ////////////////////////////////////////
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                            mysqli_close($conn);
                    }
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
            <a class="navbar-brand" href="#">Job Portal</a>
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
                            <a class="nav-link" href="admin_post_view.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="signin.php">Log In</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <form class="form-inline" action="Home.php">
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
                    echo error();
                    echo success();
                ?>
				<form class="" action="signup.php" method="post" enctype="multipart/form-data">                                              <?php//////////////////////////////////////?>
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Sign Up Form</h1>
						</div>
                        
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="name"> <span style="color:rgb(0, 153, 153) ">Full Name</span></label>
								<input class ="form-control" type="text" name="name" id="name" placeholder="Full Name" value=""> <?php echo $ename; ?>
                            </div>
                            <div class="form-group">
								<label for="email"> <span style="color:rgb(0, 153, 153) ">Email</span></label>
								<input class ="form-control" type="text" name="email" id="email" placeholder="Email Address" value=""> <?php echo $eemail; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="password"> <span style="color:rgb(0, 153, 153) ">Password</span></label>
								<input class ="form-control" type="password" name="pass" id="password" placeholder="Password" value=""> <?php echo $epass; ?>
                            </div>
                            
                            <div class="form-group">
								<label for="cpassword"> <span style="color:rgb(0, 153, 153) ">Confirm Password</span></label>
								<input class ="form-control" type="password" name="cpass" id="cpassword" placeholder="Confirm Password" value=""><?php echo $ecpass; ?> 
                            </div>

                            <div class="form-group">
								<label for="Gender"> <span class="FieldInfo"style="color:rgb(0, 153, 153)">Gender</span></label>
								<select class="form-control" id="Gender" name="gender"><?php echo $egender; ?>
                                        <option>Male</option> 
                                        <option>Female</option> 
                                </select>
                            </div>

                            <div class="form-group">
								<label for="Date"> <span style="color:rgb(0, 153, 153) ">Date of Birth</span></label>
								<input class ="form-control" type="date" name="date" id="Date" > <?php echo $edob; ?>
                            </div>

                            <div class="form-group">
                                <label for="imageSelect"> <span style="FieldInfo; color:rgb(0, 153, 153);"> Select Image</span></label>
                                    <div class="custom-file">
                                        <input class ="custom-file-input" type="File" name="image" id="imageSelect" ><?php echo $img; ?> 
                                        <label for="imageSelect" class="custom-file-label"> </label>
                                    </div>
                            </div>

                            <div class="form-group">
								<label for="AccountType"> <span class="FieldInfo"style="color:rgb(0, 153, 153)">Account Type</span></label>
								<select class="form-control" id="AccountType" name="accounttype"><?php echo $etype; ?>
                                        <option>Employer</option> 
                                        <option>Job Seeker</option> 
                                </select>
                            </div>
                            


							<div class="row">
								<div class="col-lg-12">
									<button type="submit" name="Submit" class="btn btn-success btn-block">
										Submit
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





