<?php
require_once ('config.php');
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id

$patientId = 0;


if (isset($_POST["index"], $_POST["doctor_id"])) {
    
    $doctorId = $_POST["doctor_id"];
    $rating = $_POST["index"];
    
    $checkIfExistQuery = "select * from doc_rating where booking_id = '" . $patientId . "' and doctor_id = '" . $doctorId . "'";
    if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
    }
    
    if ($rowcount == 0) {
        $insertQuery = "INSERT INTO doc_rating(booking_id, doctor_id, rating) VALUES ('" . $patientId . "','" . $doctorId . "','" . $rating . "') ";
        $result = mysqli_query($conn, $insertQuery);
        echo "success";
    } else {
        echo "Already Voted!";
    }
}


