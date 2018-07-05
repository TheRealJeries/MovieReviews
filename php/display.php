<?php
	session_start();
	require_once("supportForSelect.php");
	// echo "This is what I get".$_POST["movie_to_be_displayed"];

	$body = "";
	$host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";

	$db = connectToDB($host, $user, $password, $database);

	$name_from_select = $_POST["movie_to_be_displayed"];

	$fileToInsert = "../images/testudo.jpg";
	$docMimeType = "image/jpeg";

	$fileData = addslashes(file_get_contents($fileToInsert));

	$sqlQuery = "select * from $table where name = '".$name_from_select."'";
	$result = mysqli_query($db, $sqlQuery);

$body .= '<div><div class="w3-container"><div class="center">
<table style="opacity: 0.9;" class="table-striped table-bordered">
	<tbody><tr>
		<td class="col-xs-4">';

	if ($result->num_rows > 0) {
	    // output data of each row

		while($row = $result->fetch_assoc()){

	    	$name = $row["name"];
	    	$image = $row["image"];
	    	$description = $row["description"];
	    	$rating = $row["rating"];
	    	$total = $row["total"];

			$body .= '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
	    	$body.= <<<EOSEND
			<h2>$name</h2>
			<hr>
			<div>
			<h4>Synopsis</h4>
			$description
			<br/><br/>
			<div>

			<strong><em>Average rating:</em> $rating </strong><br>
			<strong><em>Total:</em> $total</strong> <br>
			</div><br/>
			<div>
			<a href="main.php">
				<input type="button" value="Return to main menu">
			</a>

			<a href="select.php">
				<input type="button" value="Back">
			</a>
			</div>
			<br>
			<div>
			<form action="submitReview.php" method="post">
				<input type="hidden" name="send_movie" id="send_movie" value="$name"/ >
				<input type="submit" name="send" id="send" value="Send Review"/>
				</form>
				</div>

				<hr>
EOSEND;
	    	;
	    }
			$body .= 		"</td></tr></table></div></div></div>";



	}else {
		$body = "<h3>Failed to add document $fileToInsert: ".mysqli_error($db)." </h3>";
	}

	/* Closing */
	mysqli_close($db);

	echo generatePage($body);

function connectToDB($host, $user, $password, $database) {
	$db = mysqli_connect($host, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Connect failed.\n".mysqli_connect_error();
		exit();
	}
	return $db;
}

 ?>
