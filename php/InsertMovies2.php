<?php
session_start();
	/* Inserts image */
	require_once("support.php");

	$host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";
	$db = connectToDB($host, $user, $password, $database);

	$fileToInsert = "../images/testudo.jpg";
	$docMimeType = "image/jpeg";

	$fileData = addslashes(file_get_contents($fileToInsert));

	$sqlQuery = "insert into $table (name, image, description, rating, total) values ";
	$sqlQuery .= "(\"Testudo\" ,'{$fileData}' ,\"THis is testudo\", 4.2, 32)";
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
