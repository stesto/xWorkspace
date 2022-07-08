<?php
	if (isset($_COOKIE["username"]) && isset($_COOKIE["user_id"])) {
		header("Location: bueroreservierung.php");
		die();
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/loading.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        [v-cloak] {
            visibility: hidden !important;
        }

        .login-form {
            border-radius: 15px;
            background-color: rgba(0,0,0, 0.4);
            display: flex;
            justify-content: center;
            margin-top: 80px;
            width: 650px;
            margin-left: auto;
            margin-right: auto;
            flex-direction: column;
            padding: 40px;
            backdrop-filter: blur(25px);
        }

        #background {
            width: 100%;
            height: 100%;
            background-image: url(CS_14_web.png);
            background-size: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -999999;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }

        #header {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 64pt;
            color: white;
            text-shadow: 5px 5px rgb(0 0 0 / 30%);
            margin: 0 0 20px 0;
            text-align: center;
        }

        ::placeholder {
            font-family: 'Poppins', sans-serif;
            color: #FFF9;
            font-weight: 500;
        }

        input[type=text], input[type=password] {
            padding: 5px;
            font-size: 16pt;
            color: white;
            font-weight: 500;
            background-color: #0000;
            width: 100%;
            margin: 25px 0 0 0;
            display: inline-block;
            border: none;
            border-bottom: 2px solid #ccc;
            box-sizing: border-box;
        }

        #login-btn {
            background-color: rgb(255 255 255 / 20%);
            font-weight: 500;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 30%;
            float: right;
            font-size: 12pt;
            margin: 0;
            border-radius: 3px;
        }

        button:hover {
            opacity: 0.8;
            background-color: #2c3e50;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .hidden {
            visibility: hidden;
        }
    </style>
</head>
    <body>
        <div class="login-form" id="vue-body">
                <h1 id="header">xWorkspace</h1>
				<div class="container">
					<!-- <label for="username"><b>Benutzername</b></label> -->
					<input type="text" placeholder="Name" name="username" v-model="username" v-on:keydown.enter="login">

					<!-- <label for="psw"><b>Passwort</b></label> -->
					<input type="password" placeholder="Passwort" name="psw" v-model="password" v-on:keydown.enter="login">
                    <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                        <div v-cloak :class="{ hidden: !loading }" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        <button id="login-btn" v-on:click="login" :disabled="nameMissing || passwordMissing || loading">Anmelden</button>
                    </div>
				</div>								

				</div>
        </div>

        <div id="background"></div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://unpkg.com/vue@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>