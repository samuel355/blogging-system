<?php
include 'includes/header.php';
$email = $_SESSION['userLogged'];

if(isset($_POST['update_image'])){
    $pwd = $_POST['conf_pwd'];
    $query = mysqli_query($connection, "SELECT password FROM users WHERE email = '$email'");
    $record = mysqli_fetch_array($query);
    $hashPwd = md5($pwd);
    $pwdfromdb = $record['password'];
    if($pwdfromdb == $hashPwd){
        //check if user upload new image
        if(isset($_FILES['image_file']) && $_FILES['image_file']['name'] !=="") {
            $dir = "users/profile_pics/";
            $fileName = $_FILES['image_file']['name'];
            $fileTmpName = $_FILES['image_file']['temp_name'];
            $fileExt = explode('.', $fileName);
            $fileActExt = strtolower(end($fileExt));

            $newImage = uniqid("blog", true) . "." . $fileActExt;
            $target = $dir.basename($newImage);
            if (move_uploaded_file($fileTmpName, $target)) {
                $query = mysqli_query($connection, "UPDATE users SET profile_pic = '$target' WHERE email ='$email'");
                if ($query) {
                    header("Location: profile.php");
                }else{
                    header("location: settings.php");
                    die("Something Went Wrong" . mysqli_error($connection));
                }
            }
        }
    }
    else{
        die("Password does not match");
    }
}

?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <h3 class="page-header">Update Your Profile</h3>
                    <p class="alert alert-info col-md-6"> To Update your username and email go to your<a href="profile.php">Profile</a></p>
                    <div class="col-md-12">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="com-md-6">
                                <div class="form-group">
                                    <label for="profile-image">Picture to upload</label>
                                    <input type="file" name="image_file" class="form-control" style="width: 50rem">
                                </div>
                                <div class="form-group">
                                    <label for="email">Password</label>
                                    <input type="password" name="conf_pwd" id="conf_pwd" class="form-control" style="width: 50rem">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="update_image" value="Update Your Details">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <h3 class="page-header">Update Your Password</h3>
                    <p class="alert alert-info col-md-6"> To Update your username and email go to your<a href="profile.php">Profile</a></p>
                    <div class="col-md-12">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="com-md-6">
                                <div class="form-group">
                                    <label for="profile-image">Password</label>
                                    <input type="password" name="password" class="form-control" style="width: 50rem">
                                </div>
                                <div class="form-group">
                                    <label for="email">Re-Enter Password</label>
                                    <input type="password" name="re_password" id="conf_pwd" class="form-control" style="width: 50rem">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="update_password" value="Update Your Password">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->


</body>

</html>
