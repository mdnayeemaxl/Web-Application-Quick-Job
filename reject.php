<?php require_once("include/db.php"); ?>  
<?php
if(isset($_GET["id"]))
    {
        $ID=$_GET["id"];
        $ac="Rejected";
        $sql="UPDATE apply SET status='$ac' WHERE id='$ID'";
        mysqli_query($conn, $sql);
        header("Location:employer_view.php");
    }

?>