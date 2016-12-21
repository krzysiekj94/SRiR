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
    <link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<body>
<?php
	
    session_start();

	if(isset($_SESSION['user']))
	{

		include '../../storage_srir/database/db.php';
		include '../../storage_srir/classes/manager_const.php';
		
		$login = $_SESSION['user'];
		unset($_SESSION['user']);
		session_destroy();
		setcookie( 'active', '', time() - 999999, '/', $_SERVER['SERVER_NAME'] );
		
		$isActive = 0;
		$sth = $dbh->prepare("UPDATE users SET isActive = ? 
							  WHERE login = ?");
		$sth->bindParam(1, $isActive);
		$sth->bindParam(2, $login);
		if($sth->execute());
		else
			echo "UPDATE users SET isActive error!";

		echo '<div class="text-center">
				<div class="alert alert-info">
					<strong>Wylogowałeś się!</strong><br/>Zostaniesz przekierowany do <a href="index.php">strony głównej</a>
				</div>
			</div>';
		echo '<script>setTimeout("location.href = \'index.php\';",4000);</script>';
		echo '<script src="js/cookie.js"> setCookie("active", 1, 1); </script>';
		die();
	}
	else
	{
		echo '<div class="text-center">
				<div class="alert alert-danger">
					<strong>Uwaga!</strong> Nie masz uprawnień do przeglądania tej części strony<br/>Zostaniesz przekierowany do <a href="index.php">strony głównej</a>
				</div>
			</div>';
		echo '<script>setTimeout("location.href = \'index.php\';",4000);</script>';
		die();
	}

?>
</body>
</html>