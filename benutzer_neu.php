<?php
  include_once('_helpers.php');
  ensureLogin();
  ensureAdmin();
?>

<?php

include 'api/_db.php';

if (isset ($_POST ['submit'])){

  
  $Name = $_POST ['Name'];
  $Password = $_POST ['Password'];
  $Nachname = $_POST ['Nachname'];
  $Email = $_POST ['Email'];
  $Rolle = $_POST['Rolle'];

  $sql = "insert into `Benutzer` (Name, 
  Password,Nachname,Email,Rolle)
   values ('$Name', '$Password','$Nachname', 
   '$Email', '$Rolle')";

  $con = db::getInstance();
  
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
<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>xWorkspace Admin Seite</title>
		<link rel="icon" type="image/x-icon" href="media/favicon.ico">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
		<link href="css/bueroreservierung.css" rel="stylesheet">
		<link rel="stylesheet" href="css/theme3.css"/>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->

  <title>Benutzer erstellen</title>
</head>

<body>
  <?php include('views/header.php'); ?>
  <div class="container my-5">
    <form method="post">


       <div class="mb-3">

        <label >Name</label>
        <input type="text" class="form-control" 
        placeholder="Name eingeben" 
        name="Name"autocomplete="off">

      </div>

      <div class="mb-3">

        <label >Password</label>
        <input type="text" class="form-control" 
        placeholder="Password eingeben" 
        name="Password"autocomplete="off">

      </div>

      <div class="mb-3">

        <label >Nachname</label>
        <input type="text" class="form-control" 
        placeholder="Nachname eingeben" 
        name="Nachname"autocomplete="off">

      </div>

      <div class="mb-3">

        <label >Email</label>
        <input type="text" class="form-control" 
        placeholder="Email eingeben" 
        name="Email"autocomplete="off" >

      </div>
      
      <div class="mb-3">

        <label >Rolle</label> <br>
        <input type="checkbox"  id="admin" value="admin"
        name="Rolle" >
        <label for="admin"> Administrator/in </label><br>
        <input type="checkbox"  id="user" value="user"
                name="Rolle" >
                <label for="user"> Benutzer/in </label><br>

      </div>
      

      <button type="submit" class="btn btn-primary"
      name ="submit">Speichern</button>
    </form>


  </div>




  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
</body>

</html>