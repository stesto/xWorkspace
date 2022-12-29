
<?php

include '_db.php';

?> 

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name = "viewport" content = "width=device-width, 
  initial-scale=1.0">

  <title>Benutzer</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class = "container">

<button class = "btn btn-primary my-5"> <a href="benutzer_neu.php" 
      class = "text-light">Nutzer hinzufügen</a>

</button>

	<table class="table">
    	<thead>
   	        <tr>
		    <!-- <th scope="col">ID</th> -->
      <th scope="col">Name</th>
			<!-- <th scope="col">password</th> -->
			<th scope="col">Nachname</th>
			<!-- <th scope="col">Email</th> -->
			<th scope="col">Rolle</th>
     							
            </tr>
  		</thead>
  		<tbody>
									
<?php


	$sql="select * from `Benutzer`";
    
	$con = db::getInstance();  // Wichtig: Connect nicht manuel abruf aus _db.php :)

	$result = mysqli_query($con, $sql);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {


         $id = $row['ID'];
        $name = $row['Name'];
        $password = $row['Password'];
        $nachname = $row['Nachname'];
        $email = $row['Email'];
        $rolle = $row['Rolle'];



        //  echo ' <tr>
        //         <td>' . $name . '</td>
        //         <td>' . $password . '</td> 
		// 		   <td>' . $nachname . '</td>
		// 		   <td>' . $email . '</td>
		// 		   <td>' . $rolle . '</td>
       
        echo ' <tr>
        <td>' . $name . '</td>
        <td>' . $nachname . '</td>
        <td>' . $rolle . '</td>
        <td>
                <button class= "btn btn-primary"><a href="benutzer_update.php? updateid=' . $id . '"class="text-light">Update</a></button>
            
                <button class = "btn btn-danger"><a href="Benutzer_loeschen2.php? deleteid='.$id.'"class="text-light"> Delete</a></button>
		</td>
		</tr>';
    }
}

?>
   </tbody>
</table>
</div>
</body>
</html>