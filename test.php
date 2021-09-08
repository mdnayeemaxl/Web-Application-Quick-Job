
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

	
	<section class ="container py-2 mb-4">
		<div class="row" >
			<div class="offset-lg-1 col-lg-10" >

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