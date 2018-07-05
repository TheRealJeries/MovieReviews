<?php
	/* Inserts image */
	require_once("support.php");

	$host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";
	$db = connectToDB($host, $user, $password, $database);

	$fileToInsert = "../images/500DaysOfSummer.jpg";
	$docMimeType = "image/jpeg";

	$fileData = addslashes(file_get_contents($fileToInsert));

	$sqlQuery = "insert into $table (name, image, description, rating, total) values ";
	//$sqlQuery .= "(\"Testudo\" ,'{$fileData}' ,\"THis is testudo\", 4.2, 32)";
	$sqlQuery = "insert into $table (name, image, description, rating, total) values ('500 Days Of Summer','{$fileData}','An offbeat romantic comedy about a woman who doesn\'t believe true love exists, and the young man who falls for her',7.7,10)";
	$result = mysqli_query($db, $sqlQuery);
	if ($result) {
		$body = "<h3>Document $fileToInsert has been added to the database.</h3>";
	} else { 				   ;
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
