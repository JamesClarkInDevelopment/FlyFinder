<?php


$passw="jzXkPk0HfzgZtc54";
$webserver="jclark07.lampt.eeecs.qub.ac.uk";
$user="jclark07";
$db="jclark07";


$conn = new mysqli($webserver, $user, $passw, $db);

if ($conn -> connect_error) {
    echo "Failed to connect to MySQL Database: " . $conn->connect_error;
    
}


?>