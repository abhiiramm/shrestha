<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$upi = $_POST['upi'];
	$name = $_POST['name'];
	$phnum = $_POST['phnum'];
	$email = $_POST['email'];
	$ipadd = $_SERVER['REMOTE_ADDR'];
	//check 
	if (!empty($email)) {

		//save to database
		//add phone number ip adress
		$user_id = random_num(6);
		$query = "insert into regisupi (user_id,upi,name,phnum,email,ip) values ('$user_id','$upi','$name','$phnum','$email','$ipadd')";
		mysqli_query($con, $query);
		header("Location: processing.html");
		$fp = fopen('regisupi.csv', 'a+');
		$data = array("userid-$user_id", "upi-$upi", $name, $phnum, $email, $ipadd);
		fputcsv($fp, $data);
		fclose($fp);
}
}


// payment link btn 
// why c imp 

?>


<!DOCTYPE html>
<html>

<head>
	<title> website</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" href="public\style.css" type="text/css" />

<style>
	* {
		margin: 0;
		padding: 0;
	}

	body {
		font-family: Arial, sans-serif;
	}

	.btn {
		margin-left: 10vw;
		height: 40px;
		background-image: linear-gradient(to right, #71d519 0%, #0596b788 51%, #41e80f 100%);
		text-align: center;
		text-transform: uppercase;
		transition: 0.5s;
		background-size: 200% auto;
		color: white;
		border-radius: 10px;
		display: block;
		color: white;
		padding: 20px 30px;
		border-radius: 15px;
		border: none;
		margin-top: 10px;
		cursor: pointer;
	}

	.btn:hover {
		background-position: right center;
		/* change the direction of the change here */
		color: #fff;
		text-decoration: none;
	}

	.profile {
		width: 45px;
		height: 45px;
		margin-left: 4vw;
		margin-top: 8px;

	}

	.nav {
		display: flex;
		flex-direction: row;
		border: black 7px;
		position: fixed;
		background-color: rgba(179, 54, 9, 0.39);
		backdrop-filter: blur(4px);
		height: 60px;
		width: 100%;
	}


	h1 {
		text-align: center;
	}

	.box4 {
		height: 70vh;
		width: 60vw;
		margin-left: 20vw;
		position: relative;
		box-shadow: 0 10px 10px -1px rgb(74, 187, 74);
		box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
		backdrop-filter: blur(38px);
		-webkit-backdrop-filter: blur(54px);
		animation: text-focus-in .4s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
		animation: text-focus-in .4s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;

	}

	form {
		max-width: 500px;
		margin-left: 10vw;


	}

	label {
		display: block;
		font-weight: 600;
		margin-bottom: 10px;

	}

	input[type=text],
	input[type=number],
	input[type=email],
	textarea {
		width: 50%;
		padding: 7px;
		border-radius: 5px;
		border-color: green;
		margin-bottom: 20px;
	}

	input[type=submit] {
		background-color: #4CAF50;
		color: white;
		padding: 10px 20px;
		border-radius: 5px;
		border: none;
		cursor: pointer;
	}

	input[type=submit]:hover {
		background-color: #45a049;
	}
</style>

<img src="image/Logo4.png" class="logo">
<div class="textlogo">SHRESTHA EDU.</div>

<br><br><br><br>
<br><br><br><br>
<h1>PAYMENT AND DETAILS</h1><br><br>
<br><br>
<div class="box4">
	<br><br>
	<input type="submit" value="Pay via UPI" onclick="window.location='https://www.google.com';" class="btn"><br><br>
	<form method="POST">
		<label for="upi">Transaction id (upi)</label>
		<input type="number" id="upi" name="upi" required>
		<label for="name">Full Name:</label>
		<input type="text" id="name" name="name" required>
		<label for="phone">Phone number(Whatsapp)</label>
		<input type="number" id="phnum" name="phnum" required>
		<label for="email">Email(Working)</label>
		<input type="email" id="email" name="email" required>
		<br><input type="submit" onclick="window.location='processing.html';">
	</form>

</div>
<br><br><br><br>
<br><br><br><br> <br><br><br><br>
<br><br><br><br>
</body>

</html>