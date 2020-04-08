<?php
session_start();
if (isset($_SESSION['uid'])) {
    header('location:admin/admindash.php');
}
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1 align="center">Admin Login</h1>
        <form align="center" action="login.php"  method="post">
                <label>Username: &nbsp; <input type="text" name="uname" required></label><br>
                <label>Password: &nbsp; <input type="password" name="pass" required></label><br>
                <input type="submit" name="login" value="Login">
        </form>
    </body>
</html>
<?php
include('dbcon.php');
if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    echo $qry="SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password';";
    
    $run = mysqli_query($conn, $qry);
    print_r($run);
    $row = mysqli_num_rows($run);
    echo $row; 
    
    if ($row <1){
    ?>
        <script>alert('Username or Password Not Match');
        window.open('login.php', '_self');
        </script>
        <?php
    }
    else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['id'];
        $_SESSION['uid'] = 'id';
        header("location:http://localhost/sms/admin/admindash.php");
        exit;
        
        
    }
}
?>