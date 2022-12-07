
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registrierung</div>
    <div class="content">
      <form action="insert.php" method="POST"> 
        <div class="user-details">
          <div class="input-box">
            <span class="details">Vorname</span>
            <input type="text" placeholder="Gib deinen Namen ein" name="vorname"required>
          </div>
          <div class="input-box">
            <span class="details">Nachname</span>
            <input type="text" placeholder="Gib deinen Namen ein" name="nachname"required>
          </div>
          <div class="input-box">
            <span class="details">E-mail</span>
            <input type="text" placeholder="Gib deine E-Mail ein" name="email" input id="email" type="email", pattern=".+@.*?hwr-berlin.de" required>
          </div>
          <div class="input-box">
            <span class="details">Passwort</span>
            <input type="password" placeholder="Gib dein Passwort ein" name="password" required>
          </div>
          <div class="input-box">
            <span class="details">Passwort bestätigen</span>
            <input type="password" placeholder="Bestätige dein Passwort" required>
          </div>
        </div>

        <div class="button">
          <input type="submit" name="submit" value="Registrieren">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
