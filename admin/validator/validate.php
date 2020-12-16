<?php
include "../includes/db.php";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $image = "users/profile_pics/defaults/head_".rand(1,3) . "png";
    $msg = "";
    $class = "alert alert";

    if(empty($username)){
        $msg = "<b> Username is required</b>";
        echo "<div class='$class-danger'> $msg</div>";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = "<b> Email is required</b>";
        echo "<div class='$class-danger'> $msg</div>";
    }
    elseif (strlen($password) < 6){
        $msg = "<b> Password is Short</b>";
        echo "<div class='$class-danger'> $msg</div>";
    }else{
        $password = md5($password);
        $query = mysqli_query($connection, "INSERT INTO users(username, email, password, profile_pic, role)
        VALUES('$username', '$email', '$password', '$image','$role')") ;
        if(!$query){
            $msg = "<b> Could not add User</b>";
            echo "<div class='$class-success'> $msg</div>";
        }else{
            ?>
            <script>
                window.location.assign("view_users.php");
            </script>
            <?php
        }

    }
}
