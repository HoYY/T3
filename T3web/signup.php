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
			<div class="col-md-6 col-md-offset-3">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">회원가입</h3>
					</div>
					<div class="panel-body">
						<form action='joindb.php' name='DB' method='POST'>
					    <fieldset>
							<div class="form-group">
							<label for="inputName">아이디</label>
								<input type="text" placeholder="ID" name="id" class="form-control" autofocus maxlength="20"></div>
							<div class="form-group">
							<label for="inputName">비밀번호</label>
							<input type="password" placeholder="Password" name="pw" class="form-control" maxlength="20"></div>
							<div class="form-group">
							<label for="inputName">비밀번호확인</label>
								<input type="password" placeholder="Passwordconfirm" name="pwconfirm" class="form-control" autofocus maxlength="20"></div>
							<div class="form-group">
							<label for="inputName">이름</label>	
							<input type="text" placeholder="name" name="name" class="form-control" maxlength="30"></div>
							<div class="form-group">
							<label for="inputName">회사</label>	
							<input type="text" placeholder="Company" name="company" class="form-control" autofocus maxlength="40"></div>
							<div class="form-group">
							<label for="inputName">전화번호</label>	
							<input type="text" placeholder="tell" name="tell" class="form-control" maxlength="20"></div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">가입</button>
                        </form>
                        <br>

                        <form action="./main.html" name='join' method="POST">
                            <button type="submit" class="btn btn-success btn-block">가입취소</button>
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