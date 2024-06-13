<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <!-- Add category form starts here-->
             <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-primary">
                        </td>
                    </tr>
                </table>

             </form>
            <!-- Add category form ends here  -->
            <?php 

                // Checked whether the submit is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get the value from category here
                    $title = $_POST['title'];

                    // For radio input we need to chwck whether the buttom is selected or not

                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    }

                    // Check whether the image is selcted or not and set the image name accordingly
                    // print_r($_FILES['image']);

                    // die(); // Break the Code Here
                    
                    if(isset($_FILES['image']['name']))
                    {
                        // upload the image 
                        // to upload image we need image name, source path and destination path 
                        $image_name = $_FILES['image']['name'];

                        // Upload the image only if image is selected
                        if($image_name != "")
                        {

                            // Auto rename image
                            // get extension of our image(jpeg, jpg, png) e.g. "foodpizza2.jpg"
                            $ext = end(explode('.', $image_name));

                            // Rename the image name
                            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //eg. Food_Category_834.jpg

                            
                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            // ?upload the image 
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // chheck whether the image is uplaoded or not 
                            // and if the image is not uploaded then we will stop the process and redirect the error messsage 
                            if($upload==false)
                            {
                                // set message 
                                $_SESSION['upload'] = "<div classs='error'>Failed to upload image</div>";
                                // Redirect to add category page
                                header('loaction:'.SITEURL.'admin/add-category.php');
                                // Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        // donot upload the image and set the image value as blank
                        $image_name="";
                    }



                    // 2. Create sql query to insert category into database
                    $sql = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                    ";

                    // 3. Execute the query and save in the datavase 
                    $res = mysqli_query($conn, $sql);

                    // 4. Check whether the query executed or not 
                    if($res==true)
                    {
                        $_SESSION['add']="<div class='success'>Category Added Succesfully</div>";
                        // redirect to manage category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['add']="<div class='erorr'>Failed to added category</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
            ?>
        </div>
    </div>


<?php include('partials/footer.php'); ?>


