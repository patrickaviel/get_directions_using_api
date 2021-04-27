<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$('form').submit(function() {
				var key = "DnP9mumGnYqrhhwAl0yLfoLwEA9VHY9C";
				var url = "http://www.mapquestapi.com/directions/v2/route?key="+key;
				url += "&from=";
				url += $('#from').val();
				url += "&to=";
				url += $('#to').val();
				console.log(url);
				$.get(url, function(res) {

					console.log(res);

					var html_str = "";
					if(res.info.messages.length ==0){
						html_str += "<h4>Directions from "+$('#from').val()+" to "+ $('#to').val() +"</h4>";
						html_str += "<p class='text-success'>Total Distance: " + res.route.distance + "km(s) .</p>"
						for(i=0;i<res.route.legs[0].maneuvers.length;i++){
							console.log(res.route.legs[0].maneuvers[i].narrative);
							html_str +=  "<p>"+ res.route.legs[0].maneuvers[i].narrative +"</p>";
						}
					}else{
						html_str = "<p class='text-danger'>"+ res.info.messages[0] +"</p>";
					}
					$('#directions').html(html_str);
				}, 'json');
				return false;
			});
		});
	</script>
</head>
<body>
	<div class="container">
		<div class="row">

			<div class="col-7">
				<h1 class="display-6">Go Find Ways</h1>
			</div>

			<div class="col-6 border-end">
				<form>
					<div class="mb-3 mt-5">
						<label for="from" class="form-label">From: </label>
						<input type="search" name="user_input" class="form-control w-75" id="from" placeholder="Ex: Dagupan">
					</div>
					<div class="mb-3">
						<label for="to" class="form-label">To: </label>
						<input type="search" name="user_input" class="form-control w-75" id="to" placeholder="Ex: Dagupan">
					</div>
					<input type="submit" class="btn btn-primary w-25 mx-auto" value="Go!">
				</form>
			</div>

			<div id="directions" class="col-6  mt-3">
				
			</div>

		</div>
	</div>
</body>
</html>