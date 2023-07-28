<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "shresthabussiness";
	$mail->Password = "chqvnkjtwgpwweaq";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = $_POST["name"];
		$email = $_POST["email"];
		$message = $_POST["message"];
	$mail->Subject = "contact form";
//Set sender email
	$mail->setFrom('shresthabussiness@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	// $mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = "<h1>$name $email</h1></br><p>$message</p>";
//Add recipient
	$mail->addAddress('shresthabussiness@gmail.com');
	if ( $mail->send() ) {
		echo "Email Sent..! thanks for the response";
	}else{
		echo "Message could not be sent. Mailer Error: ";
	}
}
	$mail->smtpClose();
