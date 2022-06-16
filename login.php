<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: "Segoe UI", Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #D50C2F;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
            background-color: #b10a27;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }
    </style>
</head>
    <body>
        <div style="display: flex;justify-content: center; margin-top: 80px;">
            <form action="login.html" method="post" style="width: 800px;">
            <div class="imgcontainer" style="display:flex; justify-content: center;">
                <img src="logo_baer.svg" style="height: 92px; margin-right: 30px">
                <img src="logo_schrift.svg" style=" height: 92px;">
            </div>

            <div class="container">
                <label for="uname"><b>E-Mail-Adresse</b></label>
                <input type="text" placeholder="@stud.hwr-berlin.de" name="uname" required>

                <label for="psw"><b>Passwort</b></label>
                <input type="password" placeholder="Passwort eingeben" name="psw" required>
                    
                <button type="submit">Anmelden</button>
                <label>
                <input type="checkbox" checked="checked" name="remember"> Anmeldenamen merken
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1; height: 25px">
                <span class="psw"><a href="#">Passwort vergessen?</a></span>
            </div>
            </form>
        </div>
    </body>
</html>