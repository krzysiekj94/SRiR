<?php

session_start();

include '../../../storage_srir/classes/manager_const.php';

if(isset($_SESSION["user"]))
{

	include '../../../storage_srir/database/db.php';

	$login = $_SESSION["user"];
		
	$sth = $dbh->prepare("SELECT nick, isActive
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
		$isActive = $result['isActive'];

		echo '<div class="list-group-item">
				<div class="text-center">'.$result['nick'].'</div>
		     </div>';
	}
	
		echo '</div>
			</div>';
}
else
{
	//accessDenied();
}

?>