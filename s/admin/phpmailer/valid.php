<?php
$user_id1 = urldecode($_GET["user_id2"]);
echo $user_id1;
echo "<br>";
$db = mysqli_connect("localhost", "root", "", "shrestha"); // connect to the DB
$query = $db->prepare("SELECT name,email,upi FROM regisupi WHERE user_id= $user_id1"); // prepate a query
//$query->bind_param('i', $user_id1); // binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
$query->execute(); // actually perform the query
$result = $query->get_result(); // retrieve the result so it can be used inside PHP
$r = $result->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
//echo $r['name'];
echo "<br>";
$name1 = $r['name'];
$email1 = $r['email'];
$upi1 = $r['upi'];
$phnum1 = $r['phnum'];
$ipadd = $_SERVER['REMOTE_ADDR'];
$user_id =rand(20000,99999);
$lol= rand(200,999);
$pass1=$upi1.$name1.$lol;
$username1=$name1.$user_id;
$conn = mysqli_connect("localhost", "root", "", "shrestha");
$query = "insert into regisupifinal (user_id,upi,name,phnum,email,ip,pass,username) values ('$user_id','$upi1','$name1','$phnum1','$email1','$ipadd','$pass1','$username1')";
mysqli_query($conn, $query);

// for email



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
$mail->Body = "dear $name1  cid-$user_id, your request  is <b>accepted</b> <br><b> $upi1</b> is valid hence <br> these are the credentials to login<br>
<h2>usename-$username1<br>password-$pass1</h2> see you in the arena<br>
You can contact us on the website or dm us on <b> 8891325175</b>";
//Add recipient
$mail->addAddress($email1);
if ($mail->send()) {
    echo "email Sent..! for the new response $user_id1 ";echo "<br>"; echo $email1;
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