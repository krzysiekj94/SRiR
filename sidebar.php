<?php

if(isset($_SESSION['user']))
{

	$login = $_SESSION["user"];
		
	$sth = $dbh->prepare("SELECT nick
						FROM users
						WHERE isActive = 1 AND login <> :login");
	$sth->bindParam(':login', $login);
	$sth->execute();
	$results = $sth->fetchAll();

	echo '<div class="col-md-4">
			<div class="list-group">
				<div class="list-group-item active text-center">
					Aktualnie na czacie<br/>
					<small>Lista osób</small>
				</div>';


	foreach($results as $result)
	{
		echo '<div class="list-group-item">
				<div class="text-center">'.$result['nick'].'</div>
		     </div>';
	}

	echo  '</div>
		</div>';
}
else
{
	echo '<div class="text-center">Aby skorzystać z czatu, <a href="login.php" style="color: blue;">zaloguj się</a> lub dokonaj <a href="register.php" style="color: blue;">rejestracji</a>!</div>';
}

?>