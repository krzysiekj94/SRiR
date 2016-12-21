<!DOCTYPE html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>ParallelText | Strona główna | Komunikator tekstowy</title>
		<!-- Loading jQuery -->
  	<script src="js/jquery-3.1.0.js"></script>
  	<!-- Loading Bootstrap Framework -->
  	<script src="bootstrap/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- Loading own stylesheet's -->
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <!-- Loading own script's -->
    <script src="js/login.js"></script>
    <script src="js/sha512.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container main-panel">
	<div class="row">
  <div class="content col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">
  <form class="form-register" onsubmit="return myOnSubmit(this);" action="login_redirect.php" method="POST">
  <div class="form-group">
  	<h4 class="text-center">Panel logowania</h4>
  </div>
  <div class="form-group">
    <label for="login-name">Login</label>
    <input type="text" class="form-control" id="login-name" name="login" placeholder="Wpisz login">
  </div>
  <div class="form-group">
    <label for="pass-name">Hasło</label>
    <input type="password" class="form-control" id="pass-name" name="pass" placeholder="Wpisz hasło">
  </div>
  <div class="form-group text-center">
  	<button class="btn btn-info">Zaloguj</button>
  </div>
</form>
</div>
</div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>