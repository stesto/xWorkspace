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
		<title>Demo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
		<link href="css/bueroreservierung.css" rel="stylesheet">
		<link rel="stylesheet" href="css/theme3.css"/>
	<script>
        let roomId = 
		<?php 
			if (!isset($_GET["id"]))
				echo 'undefined';
			else
				echo $_GET["id"];
		?> //"Raum ID gemeint"
    </script>
	</head>
	<body class="d-flex flex-column h-100">
		<div >
			<!-- Navbar -->
			<?php include('views/header.php'); ?>
			<!-- main ---------------------------------------------------------------------------->
			<main v-cloak id="vue-body" class="my-5">
				<div class="container-md">
					<div class="row">
						<div style="display: flex">
							<!--Raum Bearbeiten-->
							<div class="material-shadow" style="margin-bottom: 30px">
								<h4>
									<a>Raum bearbeiten</a>
								</h4>
								<div>
			
									<ul>
										<li v-for="(feature, idx) in raum.Features">
											{{feature.Name}}
											<a v-on:click="removefeature(idx)" class="btn btn-danger btn-sm">Löschen</a>
										</li>
										
									</ul>
								<div>
									<h4>Features Hinzufügen:</h4>
										<ul>
											<li v-for="(feature, id) in features">
												{{feature.Name}}
												<a v-on:click="addfeature(feature, id)" class="btn">Hinzufügen</a>
											</li>
										</Ul>
										<div style="display: flex;flex-direction: row-reverse;">
											<button v-on:click="speicherRaum()" class="btn btn-success btn-sm" style="text-align: right;">Speichern</button>
										</div>
								</div>
									<div>
										<h4>Raum Name ändern:<h4>
										<input v-model="raum.Nummer" type="text" style="width: 100%" placeholder>
									</div>
										<div>
											<h4>Standord des Raumes</h4>
											<div>
												<a>Neue Straße:</a>
												<input v-model="raum.Straße" type="text" style="width: 100%" placeholder>
											</div>
											<div>
												<a>Neue Hausnummer:</a>
												<input v-model="raum.HausNr" type="text" style="width: 100%" placeholder>
											</div>
											<div>
												<a>Ort ändern:</a>
												<input v-model="raum.Ort" type="text" style="width: 100%" placeholder>
											</div>
											<div>
												<a>PLZ ändern:</a>
												<input v-model="raum.PLZ" type="text" style="width: 100%" placeholder>
											</div>
											<div>
												<a>Platzanzahl ändern</a>
												<input v-model.number="raum.Plaetze" type="text" style="width: 100%" placeholder>
											</div>
										</div>
								
								
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
		<script src="js/bearbeiten_room.js"></script>
		<!-- <script src="js/bueroreservierung.js"></script> -->
	</body>
</html>
