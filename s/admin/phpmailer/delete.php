<?php
//session_start();
//echo "Favorite color is " . $_SESSION['variable_name'] . ".<br>";
//Include required PHPMailer files
$user_id1 = urldecode($_GET["user_id1"]);
//$conn = mysqli_connect("localhost", "root", "", "shrestha");
$db =  mysqli_connect("localhost", "root", "", "shrestha"); // connect to the DB
$query = $db->prepare("SELECT name,email,upi FROM regisupi WHERE user_id= $user_id1"); // prepate a query
//$query->bind_param('i', $user_id1); // binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
$query->execute(); // actually perform the query
$result = $query->get_result(); // retrieve the result so it can be used inside PHP
$r = $result->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
echo $r['name'];echo "<br>";
$name1=$r['name'];
$email1=$r['email'];
$upi1=$r['upi'];


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
$mail->Subject = "your shrestha course is not registered try again";
//Set sender email
$mail->setFrom('shresthabussiness@gmail.com');
//Enable HTML
$mail->isHTML(true);
//Attachment
// $mail->addAttachment('img/attachment.png');
//Email body
$mail->Body = "dear $name1  cid-$user_id1, your request  is <b> rejected</b> <br> maybe there is a fault in the 'UPI' number <b> $upi1</b>
 <b> upi </b> or maybe a fault from our end <br> we are extremely 
sorry to see you in this situation you can contact us on the website or dm us on <b> 8891325175</b>";
//Add recipient
$mail->addAddress($email1);
if ($mail->send()) {
    echo "email Sent..! for the delete response $user_id1 ";echo "<br>"; echo $email1;
} else {
    echo "Message could not be sent. Mailer Error: ";
}
$mail->smtpClose();
deletehello($user_id1);

function deletehello($userr)
{
echo "hello";
$conn = mysqli_connect("localhost", "root", "", "shrestha");
$sql = "DELETE FROM regisupi WHERE user_id=$userr";
if (mysqli_query($conn, $sql)) {
    echo "Row deleted successfully.";
    
} else {
    echo "Error deleting row: " . mysqli_error($conn);
}
die;
}
?>
