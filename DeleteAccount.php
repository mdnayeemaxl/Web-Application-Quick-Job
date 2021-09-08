<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<?php
$ID=$_GET["id"];
$acct=$_GET["act"];
if($acct=='employer'){
$sql = " DELETE FROM employer WHERE id='$ID'";
if (mysqli_query($conn, $sql)) {
    $_SESSION["success"]="Post has Deleted Successfully "; 
        header("Location:employerList.php");
}
}
else
{$sql = " DELETE FROM jobseeker WHERE id='$ID'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]="Post has Deleted Successfully "; 
            header("Location:jobseekerList.php");
    }
}


mysqli_close($conn);

?>