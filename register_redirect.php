<?php

include '../../storage_srir/database/db.php';
include '../../storage_srir/classes/manager_const.php';

	/* Define constants */
	
	$min_password_length = 6;
	$max_password_length = 20;
	
	$global_salt_hash = hash(constant("TYPE_CIPHER_SALT"),constant("GLOBAL_SALT"));
	
	if(isset($_POST["login"],$_POST["pass"],$_POST["email"]))
	{
		$login = $_POST["login"];
		$pass = $_POST["pass"];
		$email = $_POST["email"];
		
		//Sprawdzanie, czy określone warunki są spełnione
		
		if(preg_match('/\s/',$login) > 0)
		{
			echo "Login zawiera spacje!<br/>";
			header("refresh:3;url=register.php");
			die();
		}
		
		if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $login))
		{
    		echo "Login nie może zawierać znaków specjalnych!<br/>";
			header("refresh:3;url=register.php");
			die();
		}
		
		if(strlen($login) < 3)
		{
			echo "Login musi zawierać minimum 3 znaki!<br/>";
			header("refresh:3;url=register.php");
			die();
		}
		
		if(strlen($pass) < $min_password_length)
		{
			echo "Wpisane hasło jest zbyt krótki (minimum 6 znaków)!<br/>";
			header("refresh:3;url=register.php");
			die();
		}
		
		if(strlen($pass) > $max_password_length)
		{
			echo "Wpisane hasło jest zbyt długie (maksimum 20 znaków)!<br/>";
			header("refresh:3;url=register.php");
			die();
		}
		
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Podany format email'a jest niepoprawny)!<br/>";
			header("refresh:3;url=register.php");
			die();
		}
	
		// Koniec walidacji formularza 
	
		try{


			$sth = $dbh->prepare("SELECT login FROM users");
			$sth->execute();
			$results = $sth->fetchAll();
			
			
			if(sizeof($results) > 0)
			{
				if($results[0]["login"] == $login)
				{
					echo "Użytkownik o podanym loginie już istnieje!<br/>";
					header("refresh:3;url=register.php");
					die();
				}
			}
			
			$salt = hash(constant("TYPE_CIPHER_SALT"), hash(constant("TYPE_CIPHER_SALT"),$login.$global_salt_hash.time()));
			$password_hash = hash( constant("TYPE_CIPHER_SALT"), $global_salt_hash.hash( constant("TYPE_CIPHER_SALT") , $pass).$salt);
			$privileges = 1;

			$sth = $dbh->prepare("INSERT INTO users (login,nick,password_hash,salt,email,register_date,isActive) VALUES (?,?,?,?,?,NOW(),1)");
			$sth->bindParam(1,$login);
			$sth->bindParam(2,$login);
			$sth->bindParam(3,$password_hash);
			$sth->bindParam(4,$salt);
			$sth->bindParam(5,$email);

			if($sth->execute())
			{
				echo "Zostałeś pomyślnie zarejestrowany!<br/>Nastąpi teraz automatyczne zalogowanie!<br/>";
				$_SESSION["user"] = $login;
				header("refresh:3;url=index.php");
			}
			else echo "Eror: INSERT INTO users ...";
			
		}catch(Exception $e)
		{
			echo "Błąd rejestracji<br/>Error: ".$e;
			header("refresh:3;url=register.php");
			die();
		}	
	}
		 
	//header("refresh:3;url=index.php");


?>