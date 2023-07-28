<?php
include("connection.php");
include("functions.php");

// Execute a SELECT statement
$sql = "SELECT * FROM regisupi";
$result = $con->query($sql);
// Fetch all rows as an associative array
$rows = $result->fetch_all(MYSQLI_ASSOC);
//echo '<button type="button">delete</button>';
// Loop through each row and display its elements

foreach ($rows as $row) {
    foreach ($row as $key => $value) {
        echo "$key: $value<br>";

    }
    echo "<br>";
    echo "<hr>";
}
echo "<hr>";
$sql = "SELECT user_id FROM regisupi";
$conn = mysqli_connect("localhost", "root", "", "shrestha");
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        //  verify($row);
        // delete($row["user_id"]);
        echo "<form action='' method='post'>";
        echo "<br>";
        echo "<input type='checkbox' name='delete' value='" . $row["user_id"] . "'>" . $row["user_id"] . "<br>";
        echo "<input type='submit' value='delete_do_mail'>";
        echo "<br>";
        echo "<input type='checkbox' name='valid' value='" . $row["user_id"] . "'>" . $row["user_id"] . "<br>";
        echo "<input type='submit' value='valid_do_mail'>";
       // $user_id2=$row["user_id"];
       //echo "<a href="">";
        echo "<br>";
       // echo $row["user_id"] ;
        echo "</form>";
        echo "<hr>";

    }
} else {
    echo "0 results";
}
echo "<hr>";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_radio = $_POST['delete'];

   // valid($selected_radio);
}
else{
delete($selected_radio);
}


function delete($value)
{
   
    $user_id1 = $value;
   // $email1=$resultemail;
    header("Location: phpmailer/delete.php?user_id1=" . urlencode($user_id1));
    // session_start();
    //$_SESSION['variable_name'] = $value;
    //sleep(3);
    //include 'phpmailer/delete.php';

}



function valid($value1)
{
    $user_id2=$value1;
    header("Location: phpmailer/valid.php?user_id2=" . urlencode($user_id2));
}

?>
