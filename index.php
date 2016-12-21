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
    <div class="col-md-8">
          <div class="list-group messages">
            <div class="list-group-item active">
              <h4 class="text-center header-new-messages">Okno czatu</h4>
            </div>
      </div>
</div>
</div>
</div>
</body>
<?php include 'footer.php'; ?>
</html>
