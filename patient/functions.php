<?php

function patientRating($patientId, $doctorId, $conn)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM doc_rating WHERE booking_id = '" . $patientId . "' and doctor_id = '" . $doctorId . "'";
    $total_row = 0;
    
    if ($result = mysqli_query($conn, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf
    
    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}
 // endFunction
function totalRating($doctorId, $conn)
{
    $totalVotesQuery = "SELECT * FROM doc_rating WHERE doctor_id = '" . $doctorId . "'";
    
    if ($result = mysqli_query($conn, $totalVotesQuery)) {
        // Return the number of rows in result set
        $rowCount = mysqli_num_rows($result);
        // Free result set
        mysqli_free_result($result);
    } // endIf
    
    return $rowCount;
}//endFunction
