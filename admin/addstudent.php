<?php
session_start();
if (isset($_SESSION['uid'])) {
    //echo $_SESSION['uid'];
} else {
    //echo "error";
    header('location: ../login.php');
}
?>
<?php
include('header.php');
include('titlehead.php');
?>
<form action="addstudent.php" method="post" enctype="multipart/form-data">
    <table align="center" border="1" style="width: 70%; margin-top: 40px;">
        <tr>
            <th>Roll No</th>
            <td><input type="text" name="rollno" placeholder="Enter Roll No" required></td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td><input type="text" name="name" placeholder="Enter Full Name" required></td>
        </tr>
        <tr>
            <th>City</th>
            <td><input type="text" name="city" placeholder="Enter City" required></td>
        </tr>
        <tr>
            <th>Parents Contact No</th>
            <td><input type="text" name="pcon" placeholder="Enter the contact number of Parents" required></td>
        </tr>
        <tr>
            <th>Standard</th>
            <td><input type="number" name="std" placeholder="Enter Standard" required></td>
        </tr>
        <tr>
            <th>Image</th>
            <td><input type="file" name="simg" required></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    include('../dbcon.php');
    $rollno = $_POST['rollno'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $pcon = $_POST['pcon'];
    $std = $_POST['std'];
    $imagename = $_FILES['simg']['name'];
    // $tempname= isset($_FILES['simg']['temp_name']);
    //move_uploaded_file($tempname, "../dataimg/$imagename");
    $target_dir = "../dataimg/";
    $target_file = $target_dir . basename($_FILES["simg"]["name"]);
    move_uploaded_file($_FILES["simg"]["tmp_name"], $target_file);
    $qry = "INSERT INTO `student`(`rollno`, `name`, `city`, `pcontactno`, `standard`, `image`) VALUES ('$rollno' ,'$name', '$city', '$pcon', '$std', '$imagename')";
    //$qry = "INSERT INTO `student`(`id`, `rollno`, `name`, `city`, `pcontactno`, `standard`, `image`) VALUES ([NULL],[$rollno], [$name], [$city],[$pcon],[$std],[$simg])";
    //echo $qry;
    $run = mysqli_query($conn, $qry);
    if ($run == true) {
        ?>
        <script>
            alert('Data Inserted Successfully');
        </script>
        <?php
    }
}
?>