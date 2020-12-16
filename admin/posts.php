<?php
include 'includes/header.php';
include 'includes/helper.php';

//delete post
if(isset($_GET['delete_post']) && $_GET['delete_post']!== ''){
    $dlt = $_GET['delete_post'];
    if(delete('posts', 'post_id', $dlt)){
        redirect('post.php?source=');
    }else{
        die('Failed');
    }
}

//approve post
if(isset($_GET['approve_post']) && $_GET['approve_post'] !==''){
    $app_id = $_GET['approve_post'];
    if(modifyStatus($app_id)){
        redirect('posts.php?source=');
    }else{
        die("failed");
    }
}

//unapprove post
if(isset($_GET['unapprove_post']) && $_GET['unapprove_post'] !==''){
    $app_id = $_GET['unapprove_post'];
    if(modifyStatus($app_id)){
        redirect('posts.php?source=');
    }else{
        die("failed");
    }
}

//update or modify content
if(isset($_POST['modify'])){
    $eid = $_POST['editID'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $tags = $_POST['tags'];
    $img = $_POST['image'];
    $post_image = $_FILES['post_image']['name'];
    $image = "";

    //get post category id
    $query = mysqli_query($connection, "SELECT cat_id FROM categories WHERE cat_title = '$category'");
    $record = mysqli_fetch_array($query);
    $post_cat_id = $record['cat_id'];

    //check if user upload new image
    if(isset($_FILES['post_image']) && $post_image !== ''){
        $dir = "images/";
        $fileName = $_FILES['post_image']['name'];
        $fileSize = $_FILES['post_image']['size'];
        $fileTmpName = $_FILES['post_image']['tmp_name'];
        $allowed = ['png', 'jpg', 'jpeg', 'gif'];
        $fileExt = explode('.', $fileName);
        $fileActExt = strtolower(end($fileExt));

        // Check image extension is allowed
        if(!in_array($fileActExt, $allowed)){
            echo "<script> alert ('file type is not allowed')</script> ";
        }
        else if ($fileSize > 10000000){
            echo "<script> alert ('Please your file size is too long')</script> ";
        }
        else{
            $newImage = uniqid("blog", true). "." . $fileActExt;
            $target = $dir . basename($newImage);
            if(move_uploaded_file($fileTmpName, $target)){
                $image = $target;
            }
        }

    }
    else{
        $image = $img;
    }
    $query = mysqli_query($connection, "UPDATE posts SET post_title = '$title', post_author = '$author', post_category = '$category', post_category_id ='$post_cat_id', post_content = '$content', post_status = '$status', post_tags = '$tags', post_image = '$image' WHERE post_id = '$eid'");
    if($query){
        header("Location: posts.php");
    }
    //echo "<script> alert ('$eid')</script> ";

}

?>


<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">

					<h1 class="page-header">
						Welcome to the Administration Panel
					</h1>


					<?php
						if (isset($_GET['source'])) {
								$source = $_GET['source'];

						switch ($source) {
							case 'add_new':
								include "includes/add_post.php";
								break;
                            case 'edit':
                                include "includes/edit_post.php";
                                break;
							default:
								include "includes/view_post.php";
								break;
						}
		}else{
				include "includes/view_post.php";
                        }

					 ?>
</div>
				</div>


			</div>

			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
