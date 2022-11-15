<?php
	// if (!isset($_COOKIE["username"]) || !isset($_COOKIE["user_id"])) {
	// 	header("Location: login.php");
	// 	die();
	// }
?>

<!DOCTYPE html>
<html class="h-100" lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Demo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
		<link href="css/bueroreservierung.css" rel="stylesheet">
		<link rel="stylesheet" href="css/theme3.css"/>
<!--<style>
		article {
  			float: left;
  			padding: 30px;
			width: 45%;
  			background-color: #ffffff;
  			height: 450px;
		}
		section{
			content:"";
			display: table;
			clear: both;
		}
</style> -->
	</head>
	<body class="d-flex flex-column h-100">
		<div id="vue-body">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-md sticky-top bg-dark navbar-dark">
				<div class="container-md">
					<a class="navbar-brand" href="#">
						<img src="https://cdn-icons-png.flaticon.com/512/3050/3050525.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
						<b>xWorkspace</b>
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-between" id="menubar">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a href="admin.php" class="nav-link active">Admin Page</a>
							</li>
							<li>
								<a href="bueroreservierung.php" class="nav-link active">Büroreservierung</a>
							</li>
							
						</ul>
						<!-- <div v-cloak  class="navbar-nav dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center;">
								<span class="material-symbols-outlined">person</span>
								<span class="mx-1">{{ username }}</span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-item" style="user-select: none; cursor: pointer;" v-on:click="logout">Abmelden</li>
							</ul>
						</div> -->
					</div>
				</div>
			</nav>
			<!-- main -->
			<main v-cloak  class="my-5">
				<div class="container-md">
					<div class="row">
						<div style="display: flex">
							<!--Registrierten Nutzer-->
							<div class="material-shadow">
								<h4>Alle registrierten Nutzer</h4>
								<input v-model="searchString" type="text" style="width: 100%" placeholder="Nutzer suchen">
								<table>
									<tr v-for="(user, index) in usersFiltered">
										<td>
											{{ index + 1 }}. {{ user.name }}
										</td>
										<td>
											<a :href="'/user/edit.php?id=' + user.id">Bearbeiten</a>
											<span>/</span>
											<span v-on:click="removeUser(index)" class="removeUser">Löschen</span>
										</td>
									</tr>
								</table>
							</div>
							<!--Registrierten Räume-->
							<div class="material-shadow"> <!-- margin left hierrein-->
								<h4>Alle hinzugefügten Räume</h4>
								<input v-model="raumString" type="text" style="width: 100%" placeholder="Raum suchen">
								<table style="width:120%">
									<tr v-for="(room, idx) in roomsFiltered">
										<td>
											{{ idx + 1 }}. {{ room.name }}
										</td>
										<td>
											<a :href="'/user/edit.php?id=' + room.id">Bearbeiten</a>
											<span>/</span>
											<span v-on:click="removeRoom(idx)" class="removeRoom">Löschen</span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
				
         
            
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/vue@2"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/luxon@2.4.0/build/global/luxon.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
		<script src="js/admin.js"></script>
		<!-- <script src="js/bueroreservierung.js"></script> -->
	</body>
</html>
