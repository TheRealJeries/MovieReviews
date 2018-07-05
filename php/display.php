<?php
	require_once("supportForSelect.php");
	// echo "This is what I get".$_POST["movie_to_be_displayed"];

	$body = "";
	$host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";
	$db = connectToDB($host, $user, $password, $database);

	$fileToInsert = "../images/testudo.jpg";
	$docMimeType = "image/jpeg";

	$fileData = addslashes(file_get_contents($fileToInsert));

	$sqlQuery = "select * from $table where name = \"Testudo\"";
	$result = mysqli_query($db, $sqlQuery);



	if ($result->num_rows > 0) {
	    // output data of each row
	    
		while($row = $result->fetch_assoc()){

	    	$name = $row["name"];
	    	$image = $row["image"];
	    	$description = $row["description"];
	    	$rating = $row["rating"];
	    	$total = $row["total"];
			
			$body .= '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
	    	$body.= "
			<h2>$name</h2>
			<hr>
			<div>
			<h4>Synopsis</h4>
			$description
			<a href=\"main.php\">
				<input type=\"button\" value=\"Return to main menu\">
			</a>
			<a href=\"select.php\">
				<input type=\"button\" value=\"Back\">
			</a>
			</div>
			<div>

			Average rating: $rating <br>
			Total: $total <br>
			</div>

		"
	    	;
	    }

	    
		
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

