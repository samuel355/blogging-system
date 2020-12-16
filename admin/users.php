<?php include 'includes/header.php'; ?>

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
                <div class="col-md-7">
                    <h3>Add Users</h3>
                    <form id="form" action="validator/validate.php" method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <select name="role" id="role" class="form-control">
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" name="submit" id="submit">
                        </div>
                        <p id="msg" class="text-center"></p>
                    </form>
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

<!-- Ajax Calls-->
<script>
    $(document).ready(function () {
        $("#form").submit(function (e) {
            let name = document.querySelector("#username").value,
                email = document.querySelector("#email").value,
                pwd = document.querySelector("#password").value,
                role = document.querySelector("#role").value,
                submit = document.querySelector("#submit").value;

            $("#msg").load('validator/validate.php', {
                username: name,
                email: email,
                password: pwd,
                role: role,
                submit: submit
            });
                e.preventDefault();
        });
    });
</script>
</body>

</html>
