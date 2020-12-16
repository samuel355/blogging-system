<?php
include 'includes/header.php';
$email = $_SESSION['userLogged'];
$query = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");
$data = mysqli_fetch_array($query);

//Update Use info
if(isset($_POST['update'])){
    $usr = $_POST['username'];
    $em = $_POST['email'];

    if(!empty($usr) && !empty($usr)){
        $query = mysqli_query($connection, "UPDATE users SET usernam = '$usr' AND email ='$em' WHERE email = $email");
        if($query){
            $_SESSION['userLogged'] = $em;
            header("Location: profile.php");
            echo "User details updated sucessfully";
        }else{
            echo "Your Details could not be updated";
        }
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
                    <h3 class="page-header">Welcome to your profile page Username</h3>
                    <p class="alert alert-info col-md-6"> To Update your password to to the <a href="settings.php">Settings</a></p>
                    <div class="col-md-12">
                        <img src="<?php echo $data['profile_pic']?>" alt="" style="width: 150px; height: 150px">
                        <form action="" method="post">
                            <div class="com-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" style="width: 50rem" value="<?php echo $data['username']?>">
                                </div>
                                <div class="form-group">
                                    <label for="email"> Email</label>
                                    <input type="email" name="email" id="email" class="form-control" style="width: 50rem" value="<?php echo $data['email']?>">
                                </div>
                                <div class="form-group">
                                    <label for="Role">Role</label>
                                    <input type="text" name="role" id="role" class="form-control" disabled style="width: 50rem" value="<?php echo $data['role']?>">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="update" value="Update Your Details">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</body>

</html>
