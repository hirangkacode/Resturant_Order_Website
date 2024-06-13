<?php 

    // Include constant.php dile here
    include('../config/constants.php');

    // 1. get the ID to be Deleted
    $id = $_GET['id'];

    // 2. create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query executed sucessfully or not
    if($res==true)
    {
        // Query executed sucessfully
        //echo "Admin deleted";
        // Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        // Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Failed to Delete admin
        // echo "failed to delete admin";

        $_SESSION['delete'] = "<div class='error>Failed to Delete Admin.</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // 3. Redirect to manage admin page with message (sucess/error)

?>