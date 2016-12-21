<?php

session_start();

if(isset($_POST["login"],$_POST["pass"]))
{
			
	if(isset($_SESSION["user"]))
	{	
		echo "Jesteś już zalogowany!";
	}
			
	else
	{
	
		include '../../storage_srir/database/db.php';
		include '../../storage_srir/classes/manager_const.php';
	
		$global_salt_hash = hash(constant("TYPE_CIPHER_SALT"),constant("GLOBAL_SALT"));
		

		$login = $_POST["login"];
		$password_hash_user = $_POST["pass"];
		
		try{
		
		$sth = $dbh->prepare("SELECT salt, password_hash 
							FROM users
							WHERE login = ?");
		$sth->bindParam(1, $login);
		$sth->execute();
		$results = $sth->fetchAll();
	
		if(sizeof($results) == 1)
		{				
				$salt = $results[0]["salt"];
				$password_hash_from_database = $results[0]["password_hash"];
				$second_hash_password = hash( constant("TYPE_CIPHER_SALT"), $global_salt_hash.$password_hash_user.$salt);
				//echo "salt: ".$salt."<br/> Password hash from database: ".$password_hash_from_database."<br/>";
				//echo "second password hash: ".$second_hash_password."<br/>";
				if($second_hash_password == $password_hash_from_database )
				{
					echo '<div class="span10 col-md-9 content">
							<div class="alert alert-success">
								<strong>Zostałeś pomyślnie zalogowany! Przejdź do <a href="index.php">strony głównej</a></strong>
							</div>
						   </div>';
					$_SESSION['user'] = $login;
					$isActive = 1;
					$sth = $dbh->prepare("UPDATE users SET isActive = ? 
										  WHERE login = ?");
					$sth->bindParam(1, $isActive);
					$sth->bindParam(2, $login);
					if($sth->execute());
					else
						echo "UPDATE users SET isActive error!";

					$cookie_name = "active";
					$cookie_value = "1";
					setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

					echo '<script>setTimeout("location.href = \'index.php\';",1000);</script>';
					die();
				}
				else
				{
					echo "Wpisałeś złe hasło!";
				}
		} 
		else if(sizeof($results) > 1)
		{
			echo "Błąd krytyczny - istnieje więcej niż 1 użytkownik o podanym loginie!";
			die();
		}
		else
		{
			echo "Użytkownik o podanym loginie nie istnieje!";
			die();
		}
							
	   }catch(Exception $e)
	   {
		   echo "Wystąpił błąd o podanej treści: ".$e;
	   }
	}					
}
else
{
	echo '<script>setTimeout("location.href = \'index.php\';",1000);</script>';
}

?>

