<?php require_once("include/db.php"); ?>      
<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>
<?php
$ID=$_GET["id"];
$acct=$_SESSION["accounttype"];

$sql = " DELETE FROM apply WHERE id='$ID'";

if (mysqli_query($conn, $sql)) {
    $_SESSION["success"]="Post has Deleted Successfully "; 
        header("Location:applyList.php");
}
mysqli_close($conn);

?>