<?php

	//	Weather API
	
	//Pokrecemo Sessiju
	//ini_set('session.save_path',getcwd(). '/temp');
	session_start();

	//Setiramo tj. namjsetamo vermensku zonu koja ce se koristiti u skripti
	date_default_timezone_set("Europe/Sarajevo");

	//Uklucivanje konfig fajla
	require_once 'includes/config.php';
	if (!isset($_SESSION['bajo_ulogovan'])){
	header("Location: login.php");
	die();
		}

	//Provjeravmo da li se slaze sessija tj. njena vrijednost sa USERNAME konstantom,a ako se ne slaze vracamo korisnika
	//na login page
	// if (!isset($_SESSION['bajo_ulogovan']))
	// {
		// header('Location: login.php');
		// die;
	// }

	$errors = array(); //Prazan niz za smijestanje gresaka

	//Provjera da li postoji post superglobalna varijabla
	if ($_POST)
	{
		//Provjera da li su poslati podaci iz forme
		if (isset($_POST['cityname']))
		{
			$cityname = htmlentities(trim($_POST['cityname']));

			//Provjera da li je polje za unos adrese prazno
			if (!empty($cityname))
			{	
				$cityname = urlencode($cityname); //Encodiramo ime grada da bi taj parametar mogli proustiti u URL i da bi se izbjegle greske oko specijalnih karaktera ili praznog porostora
				
				$apiKey = 'ba8741aad31d92408c7b857459a1ddc0'; //API kljuc koji dobijemo kad se registrujemo na https://home.openweathermap.org/users
				$url = "api.openweathermap.org/data/2.5/weather?q={$cityname}&units=metric&APPID={$apiKey}"; //Dodavanje imena grada i api kljuca na Weather API link
				
				//Koristenje PHP ugradjene funkcije za dohvatanje sadrzaja od API-a (curl())
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		curl_setopt($ch, CURLOPT_URL, $url); 

        		$weatherJSON = curl_exec($ch);

        		//var_dump($weatherJSON); die; //Testiranje API odgovora sa servera

        		//Prebacuemo JSON u PHP asocijativni niz sa funk. json_decode
        		$response = json_decode($weatherJSON, true);

        		//echo '<pre>' , var_dump($response); die; //Testiramo pertvaranje iz JSON-a u PHP asocijativni niz
        		
        		//Ako je $response['cod'] el. niza iz odgovora od servera razlitici od 404 onda kupimo podatke iz niza
        		//U suprotnome cuvamo gresku u errors nizu
        		if ($response['cod'] != 404)
        		{
        			//Dohvatamo vrijednosti niza i smijestamo ih u varijable da ih koristimo u HTML-u
					$longitude = $response['coord']['lon'];
					$laditude = $response['coord']['lat'];

					$mainWeatherId = $response['weather'][0]['id'];
					$mainWeather = $response['weather'][0]['main'];
					$mainDescription = $response['weather'][0]['description'];
					$weatherIcon = $response['weather'][0]['icon'];

					$temp = $response['main']['temp'];
					$pressure = $response['main']['pressure'];
					$humidity = $response['main']['humidity'];

					$windSpeed = $response['wind']['speed'];
					$windDeg = ceil($response['wind']['deg']); //Zaokruzujemo na cijeli broj

					$clouds = $response['clouds']['all'];
					$cityName = $response['name'];
					$weatherCode = $response['cod'];

					$countryCode = $response['sys']['country'];
					$sunrise = date('H:m:s', $response['sys']['sunrise']); //Pretvaramo TIEMSTAMP u citljivo vrijeme
					$sunset = date('H:m:s', $response['sys']['sunset']);

					$dateTime = date('d/m/Y @ H:m:s', $response['dt']);
        		}
        		else
        		{
        			$errors[] = $response['message']; //Poruka sa tekstom opisa greske
        		}
			}
			else
			{
				$errors[] = 'Please enter some valide city name address.';
			}
		}
	}

	//Ukljucivanje headera i navigacije st.
	include_once 'includes/header.php';
	include_once 'includes/nav.php';
?>
	
	<!--Div za prikazivanje forme-->
	<div class="row">

		<!--Red u kome prikazujemo greske ako su se desile u formi-->
		<div class="row">
			<div class="col col-md-6 col-md-offset-3">
				<!--Provjera da li postoji neka od resaka u nizu-->
				<?php if ($errors) : ?>
					<ul class="list-group">
						<!--Prolaz kroz niz od gresaka i vadjenje pojedinace greske radi ispisa-->
						<?php foreach ($errors as $error) : ?>
							<li class="list-group-item list-group-item-danger"><?php echo $error; //Ispis greske ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<div class="col-md-6 col-md-offset-3">
			<h2 class="text-center">Search for local weather condition</h2>

			<div class="panel panel-default">
				<div class="panel-body">
					<form action="weather.php" method="post" autocomplete="off">
						<!--Ako imamo neku gresku na ovome input polju dodajemo 'has-error' klasu da bi polje pocrvenilo-->
						<div class="form-group <?php if ($errors) {echo ' has-error';} else {echo '';} ?>">
							<input type="text" name="cityname" placeholder="Search for Banja Luka,ba" class="form-control">
						</div>
						<button type="submit" class="btn btn-default">Search</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--Div za prikazivanje vremenskih informacija-->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<hr>
			<h2 class="text-center">Current weather condition</h2>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="weather">
						<!--City Name-->
						<p><?php echo isset($cityName) ? 'City Name: ' . $cityName . ', ' . $countryCode : '' ?></p>

						<!--Date/Time-->
						<p><?php echo isset($dateTime) ? 'Date: ' . $dateTime : '' ?></p>

						<!--Longitude & Laditiude-->
						<p><?php echo isset($longitude) ? 'Longitude: ' . $longitude . '&deg; &' : '' ?> <?php echo isset($laditude) ? 'Laditude: ' . $laditude . '&deg;' : '' ?></p>

						<!--Clouds,Rain,Sunny,Snow ...-->
						<p><?php echo isset($mainWeather) ? "<i class='wi wi-owm-{$mainWeatherId}'></i>&nbsp;{$mainWeather} ({$mainDescription})" : '' ?></p>

						<!--Temperature-->
						<p><?php echo isset($temp) ? '<i class="wi wi-thermometer"></i> &nbsp;' . $temp . ' <i class="wi wi-celsius"></i>' : '' ?></p>

						<!--Humidity-->
						<p><?php echo isset($humidity) ? '<i class="wi wi-humidity"></i>&nbsp;' . $humidity . ' %' : '' ?></p>

						<!--Pressure-->
						<p><?php echo isset($pressure) ? '<i class="wi wi-barometer"></i>&nbsp;' . $pressure . ' mm' : '' ?></p>
						
						<!--Wind direction-->
						<p><?php echo isset($windDeg) ? "<i class='wi wi-wind towards-{$windDeg}-deg'></i>&nbsp; Wind direction" : '' ?></p>

						<!--Wind Speed-->
						<p><?php echo isset($windSpeed) ? '<i class="wi wi-strong-wind"></i>&nbsp;' . $windSpeed . ' m/s &nbsp;Wind speed' : '' ?></p>

						<!--Sunrise-->
						<p><?php echo isset($sunrise) ? '<i class="wi wi-sunrise"></i>&nbsp;' . $sunrise . ' h' : '' ?></p>

						<!--Sunset-->
						<p><?php echo isset($sunset) ? '<i class="wi wi-sunset"></i>&nbsp;' . $sunset . ' h' : '' ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
	include_once 'includes/footer.php';
?>