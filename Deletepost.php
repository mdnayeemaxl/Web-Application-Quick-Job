<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<?php
$ID=$_GET["id"];
$acct=$_SESSION["accounttype"];

$sql = " DELETE FROM jobpost WHERE id='$ID'";

if (mysqli_query($conn, $sql)) {
    $_SESSION["success"]="Post has Deleted Successfully "; 
        header("Location:empallpost.php");
}
mysqli_close($conn);

?>