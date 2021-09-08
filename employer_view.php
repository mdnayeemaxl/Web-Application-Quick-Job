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
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link"href="signout.php">Log Out</a>
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
<div style="height:5px; background:#1790A2;"></div>
    <header class="bg-dark text-white py-3">
        <div class="container">

        <?php echo success() ;
                echo error();
                ?>

            <div class="row">
                <div class="col-md-12">
                    <h1><i class= "fas fa-blog" style="color:#27aae1;"></i>Employer Dashboard</h1>
                </div>
                <div class= "col-lg-3">
                    <a href="Job_Post.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i> Add New Post
                    </a>
                </div>

                <div class= "col-lg-3">
                    <a href="empallpost.php" class="btn btn-info btn-block">
                        <i class="fas fa-edit"></i> Post List
                    </a>
                </div>
                <div class= "col-lg-3">
                    <a href="" class="btn btn-success btn-block">
                        <i class="fas fa-edit"></i> Job Request
                    </a>
                </div>
            </div>
        </div>
    </header>

    


    <section  class="container py-2 mb-4">
        <div class="row" style="min-height:30px;">
            <div class="col-lg-12" style="min-height:400px;">
            <h2>Apply info</h2>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Applicant Name</th>
                        <th>Applicant Email</th>
                        <th>skills</th>
                        <th>Applied Date</th>
                        <th>Resume</th>
                        <th>Status</th>
                        <th>Approve</th>
                        <th>Regect</th>
                    </tr>
                </thead>
            
            

            <?php
            $tt=$_SESSION["empuserid"];
                $count=0;
                //$sql="SELECT * FROM apply";
                
    $sql="SELECT a.id,a.name,a.email,a.skills,a.resume,a.skid,a.postid,a.status,a.time FROM apply a CROSS JOIN jobpost j where a.postid=j.id AND j.empid='$tt'";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) { 
                        $ID=$row["id"];
                        $n=$row["name"];
                        $e=$row["email"];
                        $skill=$row["skills"];
                        $ru=$row["resume"];
                        $sk=$row["skid"];
                        $pid=$row["postid"];
                        $stus=$row["status"];
                        $tm=$row["time"];
                        $count++;
                        if($stus=="pending")
                        {

                            $aplink="";
                            $Btn="btn btn-success";
                            $Btn1="btn btn-danger";

                        }
                        else 
                        {
                            $aplink="pointer-events: none;
                            cursor: default;";
                            $Btn="btn btn-secondary";
                            $Btn1="btn btn-secondary";
                        }
                        if($stus=="Accepted")
                            {
                                $status="text-success";
                            }
                        else if($stus=="Rejected")
                        {
                            $status="text-danger";
                        }
                        else {
                            $status="text-warning";
                        }
                    
                        
            ?>
            <tbody>
                    <tr>
                        <td><?php echo $count;?></td>
                        <td><?php 

                        $sq="SELECT * FROM jobpost WHERE id='$pid'";
                        $r = mysqli_query($conn, $sq);

                        if (mysqli_num_rows($r) > 0) {
                            
                            while($ro = mysqli_fetch_assoc($r)) { 
                                $posttitle=$ro["title"];
                            }
                            echo $posttitle;
                        }
                        ?></td>
                        <td><?php echo $n;?></td>
                        <td><?php echo $e;?></td>
                        <td><?php echo $skill;?></td>
                        <td><?php echo $tm;?></td>
                        <td><a href="upload/<?php echo $ru;?>" class ="btn btn-info"> Download</a></td>
                        <td><p class="font-weight-bold  <?php echo $status;?> "><?php echo $stus;?></p></td>
                        <td><a href="approve.php?id=<?php echo $ID;?>" class="<?php echo $Btn?>" style='<?php echo $aplink;?>'>Approve</a></td>
                        <td><a href="reject.php?id=<?php echo $ID;?>" class="<?php echo $Btn1?>" style='<?php echo $aplink;?>'>Reject</a></td>
                        
                    </tr>
            </tbody>
       <?php } mysqli_close($conn);}?>
            </table>
            
            </div>
        </div>
    </section>



    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>