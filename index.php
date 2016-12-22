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
    <!-- Loading own script's -->
    <script src="js/cookie.js"></script>
    <script src="js/messages.js"></script>
    <script src="js/sidebar.js"></script>
    <!-- Loading own stylesheet's -->
    <link rel="stylesheet" type="text/css" href="css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/messages.css">
</head>
<header>
</header>
<body>
<?php include 'header.php'; ?>
<div class="container main-panel">
  <div class="row">
    <?php

      include 'sidebar.php'; 

      if(isset($_SESSION["user"]))
      {
        // own id user
        $login = $_SESSION["user"];

          echo '<div class="col-md-8">
          <div class="list-group-item active text-center">Wiadomości</div>
          <div id="chatContent">
              <div id="historyContent" class="list-group">';

            $sth = $dbh->prepare("SELECT u.nick, msg.content, send_msg.sending_date
                    FROM users AS u
                    JOIN sending_messages AS send_msg
                    ON u.iduser = send_msg.idsender
                    JOIN messages AS msg 
                    ON send_msg.idmessage = msg.idmessage");
            $sth->execute();
            $results = $sth->fetchAll();

            foreach($results as $result)
            {
              echo '<div class="list-group-item message"><b>'.$result["nick"].':</b> '.$result["content"].' <div class="pull-right">'.$result["sending_date"].'</div></div>';
            }

            echo '</div>
                  <input id="messageContent" class="form-control" type="text" placeholder="Napisz wiadomość"/>
                  <button id="sendMessageButton" class="btn btn-success pull-right">Wyślij</button> 
              </div>';  
      }

    ?>
</div>
</div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>
