<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<?php
   check_login(); 
?>
<?php
$poid=$_GET["id"];
if(isset($_POST["Submit"]))
    {   
        $fname=$_POST["name"];
        $mail=$_POST["email"];
        
        $skill=$_POST["skills"];

        $resume=$_FILES["pdf"]["name"] ;
        $Target="upload/".basename($_FILES["pdf"]["name"]);
        
        $skid=$_SESSION["seekuserid"];                                            ////////////////////////////////////////////////////////////////////////
        $status='pending';

        $time=date_time();
           
        if(empty($fname)){
            $_SESSION["Error"]="Full Name Requird";              //17
            header("Location:apply.php?id=".$poid);
        }
        elseif(empty($mail)){
            $_SESSION["Error"]="Email Address Required";              //17
            header("Location:apply.php?id=".$poid);
        }
        elseif(empty($skill)){
            $_SESSION["Error"]="Provide Skkills releted Information";              //17
            header("Location:apply.php?id=".$poid);
        }


        else{

            $sql="INSERT INTO apply (name,email,skills,resume,skid,postid,status,time) 
            VALUES ('$fname','$mail','$skill','$resume','$skid','$poid','$status','$time') ";
            if (mysqli_query($conn, $sql)) {
                move_uploaded_file($_FILES["pdf"]["tmp_name"],$Target);  
                $_SESSION["success"]="Apply Has Successfully Completed";              //focus on this line
                //reload("Job_Post.php");                          /////////////////////////////////////////////////
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
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
                            <a class="nav-link" href="profile.php">MY Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="seeker_view.php">Job Seeker Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="signout.php">Log out</a>
                        </li>

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
				<form class="" action="apply.php?id=<?php echo $poid;?>" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Apply For Job</h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"> <span style="color:rgb(0, 153, 153) ">Name</span></label>
								<input class ="form-control" type="text" name="name" id="title" placeholder="Full Name" value=""> 
                            </div>

                            <div class="form-group">
								<label for="email"> <span style="color:rgb(0, 153, 153) ">Email Address</span></label>
								<input class ="form-control" type="text" name="email" id="email" placeholder="Email Address" value=""> 
                            </div>
                            <div class="form-group">
								<label for="skills"> <span style="color:rgb(0, 153, 153) ">Skills</span></label>
								<input class ="form-control" type="text" name="skills" id="address" placeholder="Skills" value=""> 
                            </div>
                            
                      
                            <div class="form-group">
                                <label for="pdfSelect"> <span style="FieldInfo; color:rgb(0, 153, 153);">Resume</span></label>
                                    <div class="custom-file">
                                        <input class ="custom-file-input" type="File" name="pdf" id="pdfSelect" > 
                                        <label for="pdfSelect" class="custom-file-label"> </label>
                                    </div>
                            </div>


                            
                            <div class="row">
								<div class="col-lg-12">
									<button type="Submit" name="Submit" class="btn btn-success btn-block">
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