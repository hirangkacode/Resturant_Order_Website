<?php 
    // authorzation access control
    // check whether the user login or not
    if(!isset($_SESSION['user'])) //if user session is not set
    {
        // User is not logged in
        // redirect to login pagewith message
        $_SESSION['no-login-message'] = "<div class='error1 text-center'> <b>Please login to access Admin Panel.</b> </div>";
        // Redirect to login page 
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>
