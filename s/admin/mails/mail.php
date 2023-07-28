<?php
if(isset($_POST['submit'])){
    $to = $_POST['email'];
    $subject = "Bill ID: ".rand(100000,999999);
    $message = "Thank you for your purchase. Your bill ID is ".$subject.".";
    $headers = "From: abhiram.63abhi@gmail.com" . "\r\n" .
        "Reply-To: abhiram.63abhi@gmail.com" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();
    mail($to, $subject, $message, $headers);
    
    $data = array($_POST['email'], $subject);
    $fp = fopen('data.csv', 'a');
    fputcsv($fp, $data);
    fclose($fp);
}
?>
