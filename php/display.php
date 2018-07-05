<?php
	/* Inserts image */
	require_once("support.php");

	$host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";
	$db = connectToDB($host, $user, $password, $database);

	$fileToGet = "../images/testudo.jpg";
	$docMimeType = "image/jpeg";

  $name = "error";
  if (isset($_POST['movie_to_be_displayed'])) {
    $name = $_POST['movie_to_be_displayed'];
  } else {
    $body = "There has been an error! Please try again";
  }

	$sqlQuery = "select image, description, rating, total from $table where name = '$name'";
	$result = mysqli_query($db, $sqlQuery);
	if ($result) {
		$body = "<h3>Found info about $name!!</h3>";
	} else {
		$body = "<h3>Error: ".mysqli_error($db)." </h3>";
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
