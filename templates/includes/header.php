<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Proiect MVC</title>

    <!-- Bootstrap core CSS -->
    <link href="templates/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <!--  <link href="Starter%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.css" rel="stylesheet">  -->

    <!-- Custom styles for this template -->
    <link href="templates/css/custom.css" rel="stylesheet">

    <script src="Starter%20Template%20for%20Bootstrap_files/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="Starter%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
    <script src="templates/js/bootstrap.js"></script>
    <script src="templates/js/ckeditor/ckeditor.js"></script>
   <?php 
   // Check if the title is set:
   if(!isset($title)){
    $title = SITE_TITLE;
   }


   ?>

 
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Project MVC</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.php">Home</a></li>

                <?php if(!isLoggedIn()) :?>
                 <li><a href="register.php">Create an Account</a></li>
               
                <?php else: ?>
                 <li><a href="create.php">Create Topic</a></li>
                 <li><a href="cont.php?id=<?php echo getUser()['user_id']; ?>">My account</a></li>
                <?php endif; ?>
         
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
        <div class="row">
          <div class="col-md-8">
              <div class="main-col">
                   <div class="block">
                        <h1 class="pull-left"><?php echo $title; ?></h1>
                        <h4 class="pull-right">A simple PHP form engine</h4>  
                        <div class="clearfix"></div>  
                        <hr>
             <?php echo displayMessage(); ?>
            