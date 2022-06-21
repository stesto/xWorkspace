<!DOCTYPE html>
<html class="h-100" lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Demo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>
	<body class="d-flex flex-column h-100">
		<div id="vue-body">
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
			<main class="my-5">
				<div class="container-md">
					<div class="row">
						<!-- Filter Sidebar -->
						<div class="col-md-5 mb-4">
							<div class="search">
								<form action="" class="mt-5 border p-4 bg-light shadow">
									<h4 class="mb-5 text-secondary">Arbeitsplatz suchen</h4>
									<div class="row">
										<div class="mb-3 col-md-6">
											<label>Datum<span class="text-danger"></span></label>
											<input type="date" name="date" class="form-control">
											<label>Von<span class="text-danger"></span></label>
											<input type="time" name="von" class="form-control">
											<label>Bis<span class="text-danger"></span></label>
											<input type="time" name="bis" class="form-control">
										</div>
										<div class="mb-3 col-md-3">
											<label>Plätze<span class="text-danger"></span></label>
											<input type="number" name="seats" class="form-control">
										</div>
										<div class="col-md-13">
										<button class="btn btn-outline-secondary" type="button">Suchen</button>
										</div>
									</div>
								</form>
							</div>
							<!-- Reserviert -->
							<h2 style="margin-top: 20px;">Reservierungen</h2>
							<ul class="list-group my-3">
								<li v-for="reservation in reservations" class="list-group-item align-items-center">
									<div class="d-flex justify-content-between">
										<div class="container">
											<h6><b>{{ reservation.platz.raum }}</b></h6>
											<h6>{{ reservation.platz.ort }}</h6>
											<span v-for="feature in reservation.platz.features" class="badge text-bg-secondary rounded-pill">{{ feature }}</span>
										</div>
										<div style="width: 160px; margin: auto; border-left: 1px solid #dadada; padding-left: 10px;">
											<h6>{{ reservation.datum }}</h6>
											<h6>Von {{ reservation.von }} Uhr</h6>
											<h6>Bis {{ reservation.bis }} Uhr</h6>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!-- Suchergebnisse -->
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Suche..."  v-model="searchText">
							</div>
							<!-- Beispielliste -->
							<ul class="list-group my-3">
							<li v-for="platz in getFilteredRooms" class="list-group-item  align-items-center">
									<div class="d-flex justify-content-between">
										<div class="container">
											<h6><b>Raum {{ platz.Nummer }}</b></h6>
											<h6>{{ platz.Straße }} {{ platz.HausNr }}, {{ platz.PLZ }} {{ platz.Ort }}</h6>
											<span v-for="feature in platz.features" class="badge text-bg-secondary rounded-pill">{{ feature.Name }}</span>
										</div>
										<button type="button" class="btn btn-outline-primary justify-content-end" style="margin: auto;" v-on:click="toggleReservation(platz)">Reservieren</button>
									</div>
									<div v-if="platz == currentReservation" style=" margin-top: 10px; padding: 6px 0 6px 12px;">
										<h3>{{ platz.raum }} reservieren</h3>
										<div style="display: flex; justify-content: space-between; align-items: flex-end;" >
											<div>
												<label>Datum<span class="text-danger"></span></label>
												<input type="date" name="date" class="form-control" v-model="platz.datum">
											</div>
											<div>
												<label>Von<span class="text-danger"></span></label>
												<input type="time" name="von" class="form-control" v-model="platz.von">
											</div>
											<div>
												<label>Bis<span class="text-danger"></span></label>
												<input type="time" name="bis" class="form-control" v-model="platz.bis">
											</div>
											<div>
												<button type="button" class="btn btn-primary justify-content-end" style="margin-top: auto;" v-on:click="reserve(platz)">Buchen</button>
											</div>
										</div>
									</div>
								</li>
							</ul>
							<!-- Pagination -->
							<!-- <div class="d-flex justify-content-center">
								<nav>
									<ul class="pagination">
									<li class="page-item">
										<a class="page-link" href="#">
											<span>&laquo;</span>
										</a>
									</li>
									<li class="page-item active"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
											<a class="page-link" href="#">
												<span>&raquo;</span>
											</a>
									</li>
									</ul>
								</nav>
							</div> -->
						</div>
					</div>
				</div>
			</main>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/vue@2"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="js/index.js"></script>
	</body>
</html>
