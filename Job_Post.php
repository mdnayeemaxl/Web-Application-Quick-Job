<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");
if(!isset($_SESSION["accounttype"]))
{
    $_SESSION["Error"]='Bad Request';
    header("Location:Home.php");
    
}
elseif($_SESSION["accounttype"]=="Job Seeker")
    {   $_SESSION["Error"]='Bad Request';
        header("Location:Home.php");
        
    }

?>
<?php
if(isset($_POST["Submit"]))
    {   $job=$_POST["jobtitle"];
        $jobsalary=$_POST["salary"];

        $category=$_POST["category1"];

        $Image=$_FILES["image"]["name"] ;
        $Target="upload/".basename($_FILES["image"]["name"]);
        $des=$_POST["jobdescription"];
        $empid=$_SESSION["empuserid"];
        $time=date_time();
           
        if(empty($job)){
            $_SESSION["Error"]="Job title can't be empty";              //17
            reload("Job_Post.php");
        }
        elseif(empty($des)){
            $_SESSION["Error"]="Job Description can't be empty";              //17
            reload("Job_Post.php");
        }
        elseif(empty($jobsalary))
                {
                    $_SESSION["Error"]="salary field can't be empty";              //17
                    reload("Job_Post.php"); 
                }


        else{

            $sql="INSERT INTO jobpost (category,title,salary,image,jobdescription,tme,empid) VALUES ('$category','$job','$jobsalary','$Image','$des','$time','$empid') ";
            if (mysqli_query($conn, $sql)) {
                move_uploaded_file($_FILES["image"]["tmp_name"],$Target);  
                $_SESSION["success"]="New Job Circular has successfully posted ";              //focus on this line
                header("Location:employer_view.php");
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
            <a class="navbar-brand" href="Home.php">Job Portal</a>
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
                            <a class="nav-link" href="employer_view.php">Employer Dashboard</a>
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
				<form class="" action="Job_Post.php" method="post" enctype="multipart/form-data">
					<div class="card bg-secondary text-light">
						<div class="card-header">
							<h1> Add New Post </h1>
						</div>
						<div class="card-body bg-dark">
							

                            <div class="form-group">
                                    <label for="categorytitle"> <span class="FieldInfo"style="color:rgb(0, 153, 153)">Job Category</span></label>
                                    <select class="form-control" id="categorytitle" name="category1">

                                        <?php 

                                            $a="SELECT title FROM category";
                                            $result = mysqli_query($conn, $a);

                                            if (mysqli_num_rows($result) > 0) {
                                                
                                                while($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option> <?php echo $row["title"];?> </option> 
                                                <?php }
                                            } else {
                                                echo "0 results";
                                            }

                                            mysqli_close($conn);
                                        
                                        ?>

                                    </select>
                            </div>
                            <div class="form-group">

								<label for="title"> <span style="color:rgb(0, 153, 153) ">Job Title</span></label>
								<input class ="form-control" type="text" name="jobtitle" id="title" placeholder="Add New Category Title" value=""> 
                            </div>

                            <div class="form-group">
                            <label for="salary"> <span style="color:rgb(0, 153, 153) ">Salary</span></label>
                            <input class ="form-control" type="text" name="salary" id="salary" placeholder="Salary Range" value=""> 
                            </div>
                            
                      
                            <div class="form-group">
                                <label for="imageSelect"> <span style="FieldInfo; color:rgb(0, 153, 153);"> Select Image</span></label>
                                    <div class="custom-file">
                                        <input class ="custom-file-input" type="File" name="image" id="imageSelect" > 
                                        <label for="imageSelect" class="custom-file-label"> </label>
                                    </div>
                            </div>

							<div class="form-group">
								<label for="job"> <span style="FieldInfo;color:rgb(0, 153, 153) ">Job Description</span></label>
								<textarea class ="form-control" name="jobdescription" id="job" rows="8" cols="60"> </textarea>
                            </div>
                            
                            <div class="row">
								<div class="col-lg-12">
									<button type="Submit" name="Submit" class="btn btn-success btn-block">
										Post
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