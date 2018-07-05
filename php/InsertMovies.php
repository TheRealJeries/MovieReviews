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


	$sqlspit = fopen("sqlspit", "r") or die("Unable to open sql!");
	$filespit = fopen("filespit", "r") or die("Unable to open filenames!");
	$docMimeType = "image/jpeg";


	$body = "";
	$tester = "things";

		$fileToInsert = trim(fgets($filespit));
		// if($fileToInsert=="")
		// 	break;
		$fileData = addslashes(file_get_contents($fileToInsert));
		$sqlQuery = str_replace("^image^","'{hello}'",fgets($sqlspit));
		// $result = mysqli_query($db, $sqlQuery);
		// // echo $sqlQuery;
		// if ($result) {
		// 	$body = "<h3>Document $fileToInsert has been added to the database.</h3>";
		// } else {
		// 	$body = "<h3>Failed to add document $fileToInsert: ".mysqli_error($db)." </h3>";
		// }
		echo $sqlQuery;


	$fileToInsert = "../images/500DaysOfSummer.jpg";
	$docMimeType = "image/jpeg";

	$fileData = addslashes(file_get_contents($fileToInsert));

	$sqlQuery = "insert into $table (name, image, description, rating, total) values ('500 Days Of Summer','{$fileData}','An offbeat romantic comedy about a woman who doesn\'t believe true love exists, and the young man who falls for her',7.7,10)";
	$result = mysqli_query($db, $sqlQuery);
	if ($result) {
		$body = "<h3>Document $fileToInsert has been added to the database.</h3>";
	} else { 				   ;
		$body = "<h3>Failed to add document $fileToInsert: ".mysqli_error($db)." </h3>";
	}




fclose($sqlspit);
fclose($filespit);
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
