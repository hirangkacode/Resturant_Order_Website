<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Pork Bites</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body class = "hero">
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
                <br><br>

            <form action="" method="POST" class="text-center">
                Username:
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                Password: 
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="update-password.php">Forgot password</a>
                </div>

                <input type="submit" name="submit" value="Login" class="btn">   
                
                
                <div class="register-link">
                    <p>Don't have a account? <a href="add-admin.php">Regsiter</a></p>
                </div>
                      
            </form>

            
        </div>
    </body>

</html>

<?php 
    // Chechk whether the submit button is work or not

    if(isset($_POST['submit']))
    {
        //Process for login
        // 1. Get the data for login form 
        $username = $_POST['username'];
        $password = md5($_POST['password']);


        // 2. sql TO CHECK whether 
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";


        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error'>Login Error.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>