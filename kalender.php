<!DOCTYPE html>
<html class="h-100" lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Demo</title>
	
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
		<link rel="stylesheet" href="css/demo.css"/>
		<link rel="stylesheet" href="css/theme3.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
		<style>
			.container {
				background-color:"";
				height: 100px;
				width: 500px;
			}
			
		</style>	
	</head>

	<body class="d-flex flex-column h-100">
		<!-- Navbar -->
		<nav class="navbar navbar-expand-md sticky-top bg-dark navbar-dark">
			<div class="container-md">
				<a class="navbar-brand" href="#">
					<img src="https://cdn-icons-png.flaticon.com/512/3050/3050525.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
					<b>Kollaborationsplattform</b>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-between" id="menubar">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="index.php" class="nav-link active">Büroreservierung</a>
						</li>
						<li class="nav-item">
							<a href="kalender.php" class="nav-link">Kalender</a>
						</li>
					</ul>
					<div class="navbar-nav dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
							<img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="" width="24" height="24">
							<span class="mx-1">Timmy</span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Einstellungen</a></li>
							<li><a class="dropdown-item" href="#">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<!-- main -->
		<div class="popup" id="popup">
			<form action="">
				<h4 class="mb-5 text-secondary">Arbeitsplatz suchen</h4>
				<div class="row">
					<div class="mb-3 col-md-6">
						<label>Tag<span class="text-danger"></span></label>
						<input type="text" name="date" class="form-control"placeholder="dd/mm/yyyy" id="TagField">
					</div>

					<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							Zeit wählen
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="ZeitDropdown">
							<li><a class="dropdown-item" href="#">10-12</a></li>
							<li><a class="dropdown-item" href="#">12-14</a></li>
							<li><a class="dropdown-item" href="#">14-16</a></li>
						</ul>
						</div>

					<div class="mb-3 col-md-3">
						<label>Plätze<span class="text-danger"></span></label>
						<input type="text" name="seats" class="form-control" id="PlaetzeField">
					</div>
					<div class="col-md-13" onclick="onSuchen()">
						<button class="btn btn-primary" type="button">Büro suchen</button>
					</div>
				</div>
			</form>
		</div>
		<div class="popup-overlay"></div>
		<div class="container">
			<div id="caleandar"></div>
		</div>
		<script type="text/javascript" src="js/caleandar.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>

		<!-- Footer -->
		<footer class="mt-auto py-5 bg-dark"></footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	</body>
</html>
