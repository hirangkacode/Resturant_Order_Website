<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
             if(isset($_SESSION['add'])) //checking whether the session is set or not
             {
                 echo $_SESSION['add']; // displaying session message
                 unset($_SESSION['add']); //removing session message
             }
        ?>

        <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Your Name">
                        </td>
                    </tr>

                    <tr>
                        <td>User Name: </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Your Username">
                        </td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Your Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >

                        </td>
                    </tr>
                </table>

        </form>
    </div>
</div>


<?php include('partials/footer.php');?>


<?php 


    if(isset($_POST['submit']))
    {
        //1. get the data from form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Paassword Encrption with MD5

        //2. SQL Query to save the data into database

        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

    //    3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check wheather the data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //DATA INSERTED
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add']= "<div class='success'>Admin Added Successfully.</div>";
            // Redirect Page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // failed to insert data
            // echo "Failed to insert data";
             // Create a session variable to display message
             $_SESSION['add']= "<div class='error'>Failed to Add Admin.</div>";
             // Redirect Page to Add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>