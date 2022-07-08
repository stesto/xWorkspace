<?php
	if (!isset($_COOKIE["username"]) || !isset($_COOKIE["user_id"])) {
		header("Location: login.php");
		die();
	}
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
								<a href="bueroreservierung.php" class="nav-link active">Büroreservierung</a>
							</li>
						</ul>
						<div v-cloak  class="navbar-nav dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center;">
								<span class="material-symbols-outlined">person</span>
								<span class="mx-1">{{ username }}</span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-item" style="user-select: none; cursor: pointer;" v-on:click="logout">Abmelden</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			<!-- main -->
			<main v-cloak  class="my-5">
				<div class="container-md">
					<div class="row">
						<div class="col-md-7 mb-4">
							<!-- Reserviert -->
							<div style="display: flex; justify-content: space-between; margin-top: 10px;">
								<h4 >Deine Reservierungen</h2>
								<div style="display: flex;">
									<div v-for="tab in reservierungTabs" class="reservierung-tab" :class="{ 'selected': selectedTab === tab }" :title="tab.title" v-on:click="selectTab(tab)">
										<span class="material-symbols-outlined">{{ tab.symbol }}</span>
									</div>
								</div>
							</div>
							<div v-show="selectedTab === reservierungTabs[0]" class="container">
								<div id="caleandar"></div>
							</div>
							<div class="material-shadow" v-show="selectedTab === reservierungTabs[1]" >
								<div>
									<div v-for="reservation in reservations" class="reservation-div">
										<div>
											<h6 style="margin-bottom: 3px;"><b>Raum {{ reservation.Nummer }}</b></h6>
											<h6 style="margin-bottom: 3px;">{{ reservation.Straße }} {{ reservation.HausNr }}, {{ reservation.PLZ }} {{ reservation.Ort }}</h6>
											<span v-for="feature in reservation.features" class="badge text-bg-secondary rounded-pill">{{ feature.Name }}</span>
										</div>
										<div class="reservation-datetime">
											<span>{{ reservation.Datum }}</span>
											<span>{{ reservation.Von }}</span>
											<span>{{ reservation.Bis }}</span>
										</div>
										<div>
											<button type="button" class="btn btn-primary justify-content-end" style="margin-top: auto;" value="Cancel" onclick="history.go(-1)">Stornieren</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Suche -->
						<div class="col-md-5">
							<div class="material-shadow" style="margin-bottom: 10px">
								<h4>Freien Raum suchen</h4>
								<div class="room-search-fields">
									<div>
										<label>Datum<span class="text-danger"></span></label>
										<input type="date" name="date" class="form-control" v-model="reservationSearch.datum">
									</div>
									<div>
										<label>Von<span class="text-danger"></span></label>
										<input type="time" name="von" class="form-control" v-model="reservationSearch.von">
									</div>
									<div>
										<label>Bis<span class="text-danger"></span></label>
										<input type="time" name="bis" class="form-control" v-model="reservationSearch.bis">
									</div>
								</div>
								<div style="display: flex; justify-content: flex-end;">
									<button class="btn btn-outline-secondary" type="button" style="margin-top: 10px;" v-on:click="getFreeRooms" :disabled="!canGetFreeRooms">Suchen</button>
								</div>
							</div>
							<div class="input-group">
								<input type="text" class="form-control" :placeholder="arbeitsplaetze.length + ' Ergebnisse filtern ...'"  v-model="searchText">
							</div>
							<!-- Freie Räume -->
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
									<div v-if="platz == currentReservation" style=" margin-top: 10px; padding: 6px 6px 6px 12px;border-left:6px solid #555555;background-color: #e7e7e7;">
										<!--<h3>Raum {{ platz.Nummer }}</h3>-->
										<div style="display: flex; justify-content: space-between; align-items: flex-end;" >
											<div>
												<label>Datum<span class="text-danger"></span></label>
												<br />
												<label>{{ reservationBooking.datum }}</label>
												<!--<input type="date" name="date" class="form-control" v-model="platz.datum">-->
											</div>
											<div>
												<label>Von<span class="text-danger"></span></label>
												<br />
												<label>{{ reservationBooking.von }}</label>
												<!--<input type="time" name="von" class="form-control" v-model="platz.von">-->
											</div>
											<div>
												<label>Bis<span class="text-danger"></span></label>
												<br />
												<label>{{ reservationBooking.bis }}</label>
												<!--<input type="time" name="bis" class="form-control" v-model="platz.bis">-->
											</div>
											<div>
												<button type="button" class="btn btn-primary justify-content-end" style="margin-top: auto;background-color: #555555;border-color:#555555;" v-on:click="reserve(platz)">Buchen</button>
											</div>
										</div>
									</div>
								</li>
							</ul>
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
		<script src="js/caleandar.js"></script>
		<script src="js/bueroreservierung.js"></script>
	</body>
</html>
