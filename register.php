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
</head>
<header>
</header>
<body>
<?php include 'header.php'; ?>
<div class="container main-panel">
  <div class="row">
    <?php include 'sidebar.php'; ?>
    <div class="content col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">
      <form class="form-register" action="register_redirect.php" method="POST">
      <div class="form-group"><h3 class="text-center">Rejestracja</h3></div>
      <div class="form-group">
        <label for="name-user">Nazwa użytkownika</label>
          <input class="form-control input-register" type="text" id="name-user" name="login" placeholder="Wpisz nazwę użytkownika" required>
      </div>
      <div class="form-group">
        <label for="pass-user">Hasło</label>
          <input class="form-control input-register" type="password" id="pass-user" name="pass" placeholder="Wpisz hasło" required>
      </div>
      <div class="form-group">
        <label for="email-user">E-mail</label>
          <input class="form-control input-register" type="email" id="email-user" name="email" placeholder="Wpisz e-mail" required>
      </div>
      <div class="form-group text-center"><button class="btn btn-success margin-bottom register-button" type="submit">Zarejestruj!</button></div>
      </form> 
    </div>
  </div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>