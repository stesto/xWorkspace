<?php
	if (isset($_COOKIE["username"]) && isset($_COOKIE["user_id"])) {
		header("Location: bueroreservierung.php");
		die();
	}
?>

<!DOCTYPE html>
    <html>
        <head>
        <title>xWorkspace Login</title>
        <link re l="icon" type="image/x-icon" href="media/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style_login.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;800&display=swap" rel="stylesheet">


    
</head>

    <body>
        
        <div class="body" id="vue-body">

                <h1 id="banner"> <img src="media/xWorkspace Banner.svg" alt="" width="500"></h1>
          
				<div class="container">
                <div class="title">Herzlich Willkommen!</div>
                 <div class="content">
                 <div class="user-details">
                 <div class="input-box">
                 <span class="details">Name</span>
                 <input type="text" placeholder="Gib deinen Namen ein" name="username"v-model="username" v-on:keydown.enter="login">
                 </div>
                 <div class="input-box">
                 <span class="details">Passwort</span>
                 <input type="text" placeholder="Gib dein Passwort ein" name="psw" v-model="password" v-on:keydown.enter="login">
                 </div>
                <div style="display: flex; justify-content: space-between; margin-top: 40px;">
                        <div v-cloak :class="{ hidden: !loading }" class="lds-ellipsis"><div></div><div></div><div></div>
                        <div class="right">
                        <button  id="login-btn" v-on:click="login" :disabled="nameMissing || passwordMissing || loading">Login</button>
                        </div>
                        <div class="left">
                        <a href="form.php">    
                        <button id= "register-btn">Registrieren</button>
                        </a>
                        <div>
                        </div>
                        <div>
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
        
