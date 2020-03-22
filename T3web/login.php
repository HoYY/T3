<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css2/bootstrap.min.css">
<style type="text/css">
	</style>

</head>
<body>
	<br><br><br><br><br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Login</h3>
					</div>
					<div class="panel-body">
						<form action="login_check.php" name='login' method="POST">
					    <fieldset>
							<div class="form-group"><input type="text" placeholder="ID" name="id" class="form-control" autofocus maxlength="10"></div>
							<div class="form-group"><input type="password" placeholder="Password" name="pw" class="form-control" maxlength="10"></div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                        <br>

                        <form action="./signup.php" name='join' method="POST">
                            <button type="submit" class="btn btn-success btn-block">Sign up</button>
                        </form>
	                    </fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
</html>