<?php
require_once "config.php";
require_once "functions.php";

// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id

$patientId= 0;

if (isset($_POST["patient_id"])) {
$patientId= $_POST("patient_id");
}
$query = "SELECT * FROM doctor ORDER BY doc_id DESC";
$result = mysqli_query($conn, $query);

$outputString = '';

foreach ($result as $row) {
    $patientRating = patientRating($patientId, $row['doc_id'], $conn);
    $totalRating = totalRating($row['id'], $conn);
    $outputString .= '
        <div class="row-item">
 <div class="row-title">' . $row['name'] . '</div> <div class="response" id="response-' . $row['doc_id'] . '"></div>
 <ul class="list-inline"  onMouseLeave="mouseOutRating(' . $row['doc_id'] . ',' . $patientRating . ');"> ';
    
    for ($count = 1; $count <= 5; $count ++) {
        $starRatingId = $row['doc_id'] . '_' . $count;
        
        if ($count <= $patientRating) {
            
            $outputString .= '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
        } else {
            $outputString .= '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $row['doc_id'] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $row['doc_id'] . ',' . $count . ');">&#9733;</li>';
        }
    } // endFor
    
    $outputString .= '
 </ul>
 
 <p class="review-note">Total Reviews: ' . $totalRating . '</p>
 <p class="text-address">' . $row["address"] . '</p>
</div>
 ';
}
echo $outputString;

?>