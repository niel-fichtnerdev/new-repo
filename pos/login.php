
<?php
session_start();

if(isset($_SESSION['user'])){
    header("location: ./");
} 

else {

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/syspos-small.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
</head>
<body>
	<section class="login">
		<div class="login_box">
			<div class="left">
				
				<div class="contact">
					<form id="authenticate">
						<h3>Login</h3>
						<p id="authparams">Please login</p>
						<input type="text" name="username" placeholder="USERNAME">
						<input type="password" name="password" placeholder="PASSWORD">
						<button class="submit" type="submit">LOGIN</button>
					</form>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<img src="img/syspos-small.png" alt="">
					<h2>SYSPOS</h2>
					<h5>Where Efficiency Meets Simplicity</h5>
					<p>For Demo Purposes, Use default login</p>
					<p style="color: yellow">Username: admin | Password: admin</p>
				</div>
				
			</div>
		</div>
	</section>

	<script>

	function areAllInputsFilled(containerSelector) {
    var allFilled = true;

    // Find all input fields within the specified container
    $(containerSelector).find('input').each(function () {
        if ($(this).val().trim() === '') {
            allFilled = false;
            return false; // Exit the loop early
        }
    });

    return allFilled;
  }


	$("#authenticate").submit(function (event) {
		event.preventDefault();

		

		if (areAllInputsFilled("#authenticate")) {
			
		// Get the form data as a FormData object
		var formData = new FormData(this);
		formData.append('poslogin', '1'); // Add the 'complogin' parameter
	
		$.ajax({
			type: "POST",
			url: "./appserv/dataprocessor.php",
			data: formData,
			processData: false, // Important when sending FormData
			contentType: false, // Important when sending FormData
			success: function (response) {

			if(response == '1'){
				location.href="./";
			}
			else{
				$('#authparams').html('Wrong Credentials');
			}
			
			},
		});
		} else {
		$('#authparams').html('Complete all required fields!');
		}
	});

	</script>
</body>
</html>










