<?php require_once("include/db.php"); ?>
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");
if(!isset($_SESSION["accounttype"]))
{
    $_SESSION["Error"]='Bad Request';
    header("Location:Home.php");
    
}
elseif($_SESSION["accounttype"]=="Employer")
    {   $_SESSION["Error"]='Bad Request';
        header("Location:Home.php");
        
    }
elseif($_SESSION["accounttype"]=="Job Seeker")
{   $_SESSION["Error"]='Bad Request';
    header("Location:Home.php");
    
}
?>
<?php
if(isset($_POST["Submit"]))
    {
        $category=$_POST["Title"];
           
        if(empty($category)){
            $_SESSION["Error"]="Please Fill up the Input Field";
            reload("Job_category.php");
        }
        else{
            $vlu=$_POST['Title'];
            
            $sql="INSERT INTO category (title) VALUES ('$vlu') ";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]="Category Type :"." ".$vlu." " ."has uccessfully Added";              //focus on this line
                reload("Job_category.php");
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

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="Home.php"><p style="color:#27aae1;font-weight: bold;">JOB PORTAL</p></a>
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
                        <li class="nav-item ">
                            <a class="nav-link" href="aboutus.php">About US<span class="sr-only"></span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="signout.php">Log out</a>
                        </li>

                    </ul>

                </div>
            </div>    
        </div>

    </nav>
    <div style="height:1px; background:#27aae1;"></div>

    <header class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-blog" style="color:#27aae1;">ADMIN PANEL</i></h1>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Job_category.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i> Add New Job Category
                    </a>
                </div>

                <div class="col-lg-2 mb-2">
                    <a href="admin_post_view.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i> All Job Post
                    </a>
                </div>

                <div class="col-lg-2 mb-2">
                    <a href="employerList.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i> Employer List
                    </a>
                </div>

                <div class="col-lg-2 mb-2">
                    <a href="jobseekerList.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i> Job Seekers List
                    </a>
            </div>
            <div class="col-lg-2 mb-2">
                    <a href="applyList.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i> Apply List
                    </a>
            </div>

            </div>
        </div>
    </header>
	
	<section class ="container py-2 mb-4">
		<div class="row" >
			<div class="offset-lg-1 col-lg-10" >
                <?php
                    echo error();
                    echo success();
                ?>
				<form class="" action="Job_category.php" method="post">
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Add New Job category</h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"> <span style="color:rgb(0, 153, 153) ">Category Title</span></label>
								<input class ="form-control" type="text" name="Title" id="title" placeholder="Add New Category Title" value=""> 
							</div>
							<div class="row">
								<div class="col-lg-12">
									<button type="submit" name="Submit" class="btn btn-success btn-block">
										ADD
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