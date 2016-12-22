<?php
	 
session_start();

if(isset($_SESSION['user']))
{
	
	if(isset($_POST["countActualMessage"]))
	{
		include '../../../storage_srir/database/db.php';
		include '../../../storage_srir/classes/manager_const.php';	    

		$login = $_SESSION["user"];

		$countMessageInHistoryUser = $_POST["countActualMessage"]; //count message in user site
		$count_all_messages = 0; //count all messages in database where you are not sender

	    $sth = $dbh->prepare("SELECT COUNT(*) AS cnt 
	   						FROM sending_messages AS send_msg
	   						JOIN users AS u ON
	   						u.iduser = send_msg.idsender");
      	
        $sth->execute();
        $results = (int) ($sth->rowCount()) ? $sth->fetch(PDO::FETCH_OBJ)->cnt : 0;

        if($results <= 0 || $results == null)
        {
        	//echo "Wartość wiadomości 0";
        }
        else if($results >= $countMessageInHistoryUser)
        {
        	   $count_all_messages = $results;

           	   $countGettingMessage = $count_all_messages - $countMessageInHistoryUser;
           	   $indexFromGettingMessage = $count_all_messages - $countGettingMessage;

	           $sth = $dbh->prepare("SELECT u.nick, msg.content, send_msg.sending_date
		       FROM users AS u 
		       JOIN sending_messages AS send_msg 
		       ON u.iduser = send_msg.idsender 
		       JOIN messages AS msg ON 
		       send_msg.idmessage = msg.idmessage
		       LIMIT :indexFromGettingMessage , :countGettingMessage");
		      
		      $sth->bindParam(':indexFromGettingMessage', $indexFromGettingMessage, PDO::PARAM_INT);
		      $sth->bindParam(':countGettingMessage', $countGettingMessage, PDO::PARAM_INT);
		      $sth->execute();
		      $resultsMessage = $sth->fetchAll();

		      foreach($resultsMessage as $resultMessage)
		      {
		        echo '<div class="list-group-item message"><b>'.$resultMessage["nick"].':</b> '.$resultMessage["content"].' <div class="pull-right">'.$resultMessage["sending_date"].'</div></div>';
		      }
        }
        else
        {
        	echo "Bład!";
        }

	  }
}

?>