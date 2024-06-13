<?php 
    // include constants file
    include('../config/constants.php');

    // echo "delete page";
    // Check whether the id and image_name value is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // get the value and delete
        // echo "Get the Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file is avilable 
        if($image_name != "")
        {
            // Image is available. So remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete from database
        // SQL Query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the data is delete from database or not
        if($res==true)
        {
            // set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

            // redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // set failed messsage and redirect 
            $_SESSION['delete'] = "<div class='success'>Failed to Delete Category.</div>";

            // redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        
    }
    else
    {
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>