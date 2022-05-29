<?php if(!isset($_SESSION)){
	session_start();
	}  
?>

<?php include('header.php'); ?>
<?php include('uptomenu.php'); ?>
<head>
<style>
body {
    font-family: arial;
}

ul {
    margin: 0px;
    padding: 10px 0px 0px 0px;
}

li.star {
    list-style: none;
    display: inline-block;
    margin-right: 5px;
    cursor: pointer;
    color: #9E9E9E;
}

li.star.selected {
    color: #ff6e00;
}

.row-title {
    font-size: 20px;
    color: #00BCD4;
}

.review-note {
    font-size: 12px;
    color: #999;
    font-style: italic;
}
.row-item {
    margin-bottom: 20px;
    border-bottom: #F0F0F0 1px solid;
}
p.text-address {
    font-size: 12px;
}
</style>
</head>

<body onload="showDoctorData('getRatingData.php')">
    <div class="container">
        <h2>Doctor Rating</h2>
        <span id="doctor_list"></span>
    </div>

<?php
    include('config.php');
    if(isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
    }
    else {
	echo "Failure";
}
?>

<script type="text/javascript">
    var b_id = '<?=$id?>';

    function showDoctorData(url)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("doctor_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", url, true);
        var para = "patient_id=" + b_id; 
        xhttp.send(para);

    } 

    function mouseOverRating(doctorId, rating) {

        resetRatingStars(doctorId)

        for (var i = 1; i <= rating; i++)
        {
            var ratingId = doctorId + "_" + i;
            document.getElementById(ratingId).style.color = "#ff6e00";

        }
    }

    function resetRatingStars(doctorId)
    {
        for (var i = 1; i <= 5; i++)
        {
            var ratingId = doctorId + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }

   function mouseOutRating(doctorId, patientRating) {
	   var ratingId;
       if(patientRating !=0) {
    	       for (var i = 1; i <= patientRating; i++) {
    	    	      ratingId = doctorId + "_" + i;
    	          document.getElementById(ratingId).style.color = "#ff6e00";
    	       }
       }
       if(patientRating <= 5) {
    	       for (var i = (patientRating+1); i <= 5; i++) {
	    	      ratingId = doctorId + "_" + i;
	          document.getElementById(ratingId).style.color = "#9E9E9E";
	       }
       }
    }

    function addRating (doctorId, ratingValue) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200) {

                    showDoctorData('getRatingData.php?id=');
                    
                    if(this.responseText != "success") {
                    	   alert(this.responseText);
                    }
                }
            };

            xhttp.open("POST", "insertRating.php?id=", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var parameters = "index=" + ratingValue + "doctor_id=" + doctorId + "patient_id=" + b_id;
            xhttp.send(parameters);
    }
</script>
	
 <?php include('footer.php'); ?>


	
	</div><!--  containerFluid Ends -->




	<script src="js/bootstrap.min.js"></script>

    	
</body>
</html>
