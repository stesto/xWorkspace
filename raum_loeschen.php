<?php

include '_db.php';


if (isset ($_POST['id'])){ //IF Bedingung, die prüft, ob eine Id (raum id) angekommen ist
    $id = $_POST['id'];
    
    $sql = "delete from `Raum_Feature` where RaumID = $id"; // hier werden die Tabellen mit FK zuerst entfernt und dann die Tabellen mit PK
    Raum_Loeschen($sql);
   
    $sql = "delete from `Reservierung` where RaumID=$id;";
    Raum_Loeschen($sql);

    $sql = "delete from `Raum` where id=$id;";
    Raum_Loeschen($sql);
  }
    
// Methode

function Raum_Loeschen( $sql){ // Verbindung zur Datenbank
  $con = db::getInstance();  // Wichtig: Connect nicht manuel abruf aus _db.php :)

        if($con){ //Prüfung ob Datenbank verbunden wurde mit $con = connect
            echo "Connecting Server";
            // Loeschen
            $result = mysqli_query($con, $sql);
                if ($result){
             
                echo "Deleted successfully";
                    
                  // header('location:admin.php');
                }else{
                echo "db fehler";
                die(mysqli_error($con));
                }
        }else{
        echo "NO Connecting Server";
        die(mysqli_error($con));
        }
}

?>