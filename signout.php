<?php require_once("include/function.php");?>
<?php require_once("include/sessions.php");?>

<?php
        
        $_SESSION["empuserid"]=null;
        $_SESSION["seekuserid"]=null;
        $_SESSION["username"]=null;
        $_SESSION["accounttype"]=null;
        session_destroy();
        header("Location:Home.php");
        
?>