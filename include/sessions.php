<?php
session_start(); 
function error(){
if( isset($_SESSION["Error"])){

    $view="<div class=\"alert alert-danger\">";
    $view.=($_SESSION["Error"]);
    $view.="</div>";
    $_SESSION["Error"]=null;
    return $view;  
}

}

function success(){
    if( isset($_SESSION["success"])){
    
        $view="<div class=\"alert alert-success\">";
        $view.=htmlentities($_SESSION["success"]);
        $view.="</div>";
        $_SESSION["success"]=null;
        return $view;
    
        
        
    }
    
    }
    function check_login(){
        if(isset($_SESSION["seekuserid"]))
        {return true;}
        else { $_SESSION["Error"]="Login Required";
            header("Location:signin.php");}
    }
    function check_log(){
        if(isset($_SESSION["accounttype"]))
        {return true;}
        else { $_SESSION["Error"]="Login Required";
            header("Location:Home.php");}
    }
?>