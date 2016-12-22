<?php

// TODO sending data jquery
session_start();

if(isset($_SESSION["user"]))
{
	if(isset($_POST["contentMessage"]))
	{

		include '../../../storage_srir/database/db.php';
		include '../../../storage_srir/classes/manager_const.php';

		$login = $_SESSION["user"];
		$id_sender = 0;
		$nick = "";
		$dateTimeSendingMsg = "";

		$content_message = $_POST["contentMessage"];
		$isSuccess = false;

		$sth = $dbh->prepare("SELECT iduser, nick FROM users WHERE login = ?");
		$sth->bindParam(1, $login);
		$sth->execute();
		$results = $sth->fetchAll();

		if(count($results))
		{
			$id_sender = $results[0]["iduser"];
			$nick = $results[0]["nick"];
		}

	
			$id_message = 0;

			$sth = $dbh->prepare("INSERT INTO messages (content) VALUES (?)");
			$sth->bindParam(1,$content_message);
			if($sth->execute())
			{
				$id_message = $dbh->lastInsertId('messages');
				$dateTimeSendingMsg = date('Y-m-d H:i:s');

				$sth = $dbh->prepare("INSERT INTO sending_messages (idmessage,idsender,sending_date) VALUES (?,?,?)");
				$sth->bindParam(1,$id_message);
				$sth->bindParam(2,$id_sender);
				$sth->bindParam(3,$dateTimeSendingMsg);
				if($sth->execute())
				{
					$isSuccess = true;
				}

				else echo "Eror: INSERT INTO messages ...";

			}
			
			else echo "Eror: INSERT INTO messages ...";


		if($isSuccess === true)
		{
			echo '<div class="list-group-item"><b>'.$nick.':</b> '.$content_message.' <div class="pull-right">'.$dateTimeSendingMsg.'</div></div>';
		}

	}
}
else 
{
	echo "Nie jesteś zalogowany!";
}

?>