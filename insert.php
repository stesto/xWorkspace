<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['vorname']) && isset($_POST['nachname']) &&
        isset($_POST['password']) && isset($_POST['email']) 
        ) {
        
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $password = $_POST['password'];
        $email = $_POST['email'];
       


        $host = "10.50.200.50";
        $dbUsername = "xws_user";
        $dbPassword = "xws123";
        $dbName = "db_xws";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT Email FROM Benutzer WHERE Email = ? LIMIT 1";
            $Insert = "INSERT INTO Benutzer(Name, Nachname, Password, Email) values(?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssss",$vorname,$nachname, $password, $email);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>