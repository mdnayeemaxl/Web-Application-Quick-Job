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
                            <a class="nav-link" href="employer_view.php">Employer Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link"href="signout.php">Log Out</a>
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
                <?php echo success() ;
                echo error();
                ?>
                    <h1><i class="fas fa-blog" style="color:#27aae1;">All Job Post</i></h1>
                </div>
            </div>
        </div>
    </header>


    <section class="container py-2 mb-4">
        <div class="row ">
            <div class="col-lgl12">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Job Category</th>
                        <th>Job Title</th>
                        <th>Image</th>
                        
                        <th>Post_Time</th>
                        <th></th>
                        <th>Actions</th>
                        <th></th>
 
                    </tr>
                    </thead>
                    <?php
                    $Id=$_SESSION["empuserid"];
                    $c=1;
                    $sql= "SELECT * FROM jobpost WHERE empid='$Id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) { $iid=$row["id"];?>
                        <tbody>
                        <tr>
                           <td><?php echo $c;$c++;?></td> 


                           <td>
                                <?php 
                                    $temp=$row["category"];
                           
                                    if(strlen($temp)>10)
                                        {
                                        $temp= substr($temp,0,8).'..';
                                        }
                                        echo $temp;
                           
                                ?>
                           </td> 

                           <td>          
                                <?php 

                                    $temp1=$row["title"];

                                    if(strlen($temp1)>18)
                                        {
                                        $temp1= substr($temp1,0,18).'..';
                                        }
                                        echo $temp1;

                                ?>                               
                           </td>
                           <td><img src='upload/<?php echo $row["image"]?>'  width="170px;"height="54px;"</td> 
                           
                           <td><?php echo $row["tme"];?></td> 
                           <td><a href="Editpost.php?id=<?php echo $iid;?>"><span class="btn btn-warning">Edit</span></a></td>
                           <td><a href="Deletepost.php?id=<?php echo $iid;?>"><span class="btn btn-danger">Delete</span></a></td>
                           <td><a href="fullpost.php?id=<?php echo $iid;?>"><span class="btn btn-primary">Full Post</span></a></td>
                        </tr>
                        </tbody>

                       <?php }
                    } else {
                        echo "0 results";
                    }

                    mysqli_close($conn);

                    ?>
                </table>
            </div>
        </div>
    </section>
    
    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>