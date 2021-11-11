<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css">
      <title>SIMUK ITERA</title>
    <!-- jQuery library -->
    <script src="<?=base_url()?>assets/jquery.js"></script>

    <script src="<?=base_url()?>assets/canvasjs.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="<?=base_url()?>assets/fontawesome/css/font-awesome.min.css">
  </head>

<center>
<img src="<?=base_url()?>assets/403-acces-denied.png">
<br><br>
<div class="alert alert-danger">
<p style="color: red">Maaf, anda tidak memiliki hak akses untuk masuk ke halaman ini ! </p>
<p style="color: red"> IP Anda : <?=$_SERVER['REMOTE_ADDR']?> </p>
</div>
</center>

 <?php
    if(isset($_GET['debug'])){
    	echo "<h4>debug session : </h4>";
    	echo "<pre>";
    	var_dump($_SESSION);
    	echo "</pre>";
    }
  ?> 

</html>
