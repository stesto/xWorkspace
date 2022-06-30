<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/loading.css"/>
    <style>
        body {font-family: "Segoe UI", Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        .background {
            width: 100%;
            height: 100%;
            background-image: url("CS_14_web.png");
            background-repeat: no-repeat;
            position: absolute; 
            top:0;
            left:0;
            z-index: -999999;

            filter: blur(8px);
            -webkit-filter: blur(8px);
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #45405d;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
            background-color: #33313d;
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
        <div id="vue-body" style="display: flex;justify-content: center; margin-top: 80px;">
            <div action="login.php" method="post" style="width: 800px;">
				<div class="imgcontainer" style="display:flex; justify-content: center;">
					<!--<img src="logo_baer.svg" style="height: 92px; margin-right: 30px">
					<img src="logo_schrift.svg" style=" height: 92px;">-->
				</div>

				<div class="container">
					<label for="username"><b>Benutzername</b></label>
					<input type="text" placeholder="Benutzername" name="username" v-model="username">

					<label for="psw"><b>Passwort</b></label>
					<input type="password" placeholder="Passwort eingeben" name="psw" v-model="password">
                    
					<button v-on:click="login" :disabled="nameMissing || passwordMissing || loading">Anmelden</button>
					<label>
					<input type="checkbox" checked="checked" name="remember"> Anmeldenamen merken</label>
                    <div v-if="loading" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
				</div>								

				<div class="container" style="background-color:#f1f1f1; height: 25px">
					<span class="psw"><a href="#">Passwort vergessen?</a></span>
				</div>
            </div>
        </div>
        <div class="background">
        </div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://unpkg.com/vue@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>