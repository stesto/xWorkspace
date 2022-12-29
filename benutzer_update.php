<?php
  include_once('_helpers.php');
  ensureLogin();
  ensureAdmin();
?>

<?php

include 'api/_db.php';

$id=$_GET['id'];

$con = db::getInstance();

$sql = "Select * from `Benutzer` Where id = $id";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$Name = $row['Name'];
$Password = $row['Password'];
$Nachname = $row['Nachname'];
$Email = $row['Email'];
$Rolle = $row['Rolle'];


if (isset ($_POST ['submit'])){

    $Name = $_POST ['Name'];
    $Password = $_POST ['Password'];
    $Nachname = $_POST ['Nachname'];
    $Email = $_POST ['Email'];
    $Rolle = $_POST['Rolle'];

    $con = db::getInstance();
  
     $sql = "update `Benutzer` set id='$id', Name = '$Name',
     Password ='$Password', Nachname='$Nachname' ,
     Email ='$Email', Rolle = '$Rolle' where id=$id";
 

   $result = mysqli_query($con, $sql);
   
   if ($result) {
  
      //echo "Data inserted successfully";
      header('location:admin.php');
    }else{
      die(mysqli_error($con));
    }
  
  }
  ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>xWorkspace Admin Seite</title>
		<link rel="icon" type="image/x-icon" href="media/favicon.ico">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
		<link href="css/bueroreservierung.css" rel="stylesheet">
		<link rel="stylesheet" href="css/theme3.css"/>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
	</head>
  </head>
  
  <body>
  <?php include('views/header.php'); ?>
    <div class= "container my-5">
    <form method="post">
    
    <!-- Textfelder -->
    
    <div class="mb-3">

<label >Name</label>
<input type="text" class="form-control" 
placeholder="Name eingeben" 
name="Name"autocomplete="off" value=<?php echo $Name;?>>

</div>

<div class="mb-3">

<label >Password</label>
<input type="text" class="form-control" 
placeholder="Password eingeben" 
name="Password"autocomplete="off" value=<?php echo $Password;?>>


<div class="mb-3">

<label >Nachname</label>
<input type="text" class="form-control" 
placeholder="Nachname eingeben" 
name="Nachname"autocomplete="off" value=<?php echo $Nachname;?>>

</div>

<div class="mb-3">

<label >Email</label>
<input type="text" class="form-control" 
placeholder="Email eingeben" 
name="Email"autocomplete="off" value=<?php echo $Email;?>>

</div>

</div>
      
<div class="mb-3">

  <label >Rolle</label>
  <input type="text" class="form-control" 
  placeholder="Rolle eingeben" 
  name="Rolle"autocomplete="off" value=<?php echo $Rolle;?>>

</div>


    <!--Button -->
    <button type="submit" class="btn 
    btn-primary" name="submit">Speichern</button>
    </form>


</body>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
</html>
