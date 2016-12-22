<?php
include '../../storage_srir/database/db.php';
include '../../storage_srir/classes/manager_const.php';
?>

<header>
	<div class="jumbotron" style="background-color: ;">
		<div class="container header-text">
			<h3 class="text-center">ParallelText | Komunikator tekstowy</h3>
		</div>
	</div>
	<div class="container">
		<nav class="navbar navbar-light text-center" style="background-color: green">
			<ul class="nav navbar-nav">
				<?php 
				
				session_start();

				//include '../../storage_od/database/db.php';
				//include '../../storage_od/classes/manager_const.php';

				if(isset($_SESSION['user']))
				{
					
					$login = $_SESSION['user'];

				  echo '<li class="nav-item welcome-text">
							<a class="nav-link">Witaj '.$login.'</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php">Komunikator</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Wyloguj</a>
						</li>';
				}
				else
				{

				  echo '<li class="nav-item">
							<a class="nav-link" href="index.php">Strona główna</a>
						</li>
				  		<li class="nav-item">
							<a class="nav-link" href="register.php">Rejestracja</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Logowanie</a>
						</li>';
				}
				
				?>
			</ul>
		</nav>
	</div>
</header>