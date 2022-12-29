<?php
	include_once('_helpers.php');
	ensureLogin();
	ensureAdmin();
?>

<!DOCTYPE html>
<html class="h-100" lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>xWorkspace Admin Seite</title>
		<link rel="icon" type="image/x-icon" href="media/favicon.ico">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
		<link href="css/bueroreservierung.css" rel="stylesheet">
		<link rel="stylesheet" href="css/theme3.css"/>
	</head>
	<body class="d-flex flex-column h-100">
		<div>
			<!-- Navbar -->
			<?php include('views/header.php'); ?>
			<!-- main -->
			<main v-cloak id="vue-body" class="my-5">
				<div class="container-md">
					<div class="row">
						<div style="display: flex">
							<!--Registrierten Nutzer-->
							<div class="material-shadow">
								<h4>Alle registrierten Nutzer</h4>
								
								<a :href="'benutzer_neu.php?=new'" class="btn btn-primary btn-sm">Benutzer hinzufügen</a>
								
								<input v-model="searchString" type="text" style="width: 100%" placeholder="Nutzer suchen">
								<table style="width:100%">
									<tr v-for="(user, index) in usersFiltered">
										<td>
											{{ index + 1 }}. {{ user.Name }}
										
										</td>
										<td>
											<a :href="'benutzer_update.php?id=' + user.ID" class="btn btn-secondary btn-sm">Bearbeiten</a>
											<span v-on:click="removeUser(user)" class="btn btn-danger btn-sm">Löschen</span>
										</td>
									</tr>
								</table>
							</div>
							<!--Registrierten Räume-->
							<div class="material-shadow" style="margin-left: 20px;">
							
								<h4>Alle hinzugefügten Räume</h4> 
								
								<a :href="'bearbeiten_room.php?=new'"class="btn btn-primary btn-sm ">Raum hinzufügen</a>	

								<input v-model="raumString" type="text" style="width: 100%" placeholder="Raum suchen">
								<table style="width:100%">
									<tr v-for="(room, idx) in roomsFiltered">
										<td>
											{{ idx + 1 }}. {{ room.Nummer }}
										</td>
										<td>
											<a :href="'bearbeiten_room.php?id=' + room.ID"	class="btn btn-secondary btn-sm">Bearbeiten</a>
											<span v-on:click="removeRoom(room)" class="btn btn-danger btn-sm">Löschen</span>
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
