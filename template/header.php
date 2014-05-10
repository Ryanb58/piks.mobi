<?php

//Required connection to database.
require_once("config.inc.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>TITLE</title>

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="css/bootstrap-theme.css" rel="stylesheet" />
	
	<link href="css/template.css" rel="stylesheet" />

  <!-- Load all the javascript after... -->
  <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
  <script type="test/javascript" src="js/bootstrap.min.js"></script>
  
	
	<meta name="viewport" content="width=dvice-width, initial-scale=1.0" />
	
</head>
<body>
<div id="wrapper">
	<!-- Static navbar -->
      <div class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">piks.mobi</a>
          </div>
          <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="./">Default</a></li>
              <li><a href="upload.php">Upload</a></li>
              <li><a href="#">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
	<div>