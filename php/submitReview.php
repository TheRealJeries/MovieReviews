<?php
session_start();
	/* Inserts image */
    require_once("supportForSelect.php");
    if (isset($_POST['send_movie'])) {
      $movieName = $_POST['send_movie'];
    } else {
      $movieName = "Movie Name";
    }
    //$MovieNAme does not exist yet
    $body = '<div><div class="w3-container"><div class="center">
    <table style="opacity: 0.9;" class="table-striped table-bordered">
    	<tbody><tr>
    		<td class="col-xs-4">';
    $host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";
    //$db = connectToDB($host, $user, $password, $database);
    $db_connection = new mysqli($host, $user, $password, $database);

    if(!isset($_POST["submit"])){
    $body .= <<<EOBODY

    <h2>$movieName</h2><br><br>

    <form action="" method="post">

        Rating: <input type="number" id="rating" name="rating" min="0" max="10" step="0.1"> /10 <br><br>
        <input type="submit" name="submit" id="submit" value="Submit"><br>

    </form>

    <a href="select.php">
      <input type="button" value="Back">
    </a>
</td></tr></table>

EOBODY;




    }else{


        $rating = 0;
        $total = 0;

        //$sqlQuery = "insert into $table (name, image, description, rating, total) values ";
        $query = sprintf("select rating, total from movies where name = '%s'", $movieName);

        $result = $db_connection->query($query);

        if($result){
            /* Number of rows found */
            $num_rows = $result->num_rows;
            if ($num_rows === 0) {
                //echo "Empty Table<br>";
            } else {
                for ($row_index = 0; $row_index < $num_rows; $row_index++) {
                    $result->data_seek($row_index);
                    $row = $result->fetch_array(MYSQLI_ASSOC);


                    /*echo "Name: {$row['name']}<br> Email: {$regem}<br> GPA: {$row['gpa']}<br> Year: {$row['year']}<br> Gender: {$row['gender']} <br><br>";
                    echo " <form action=\"main.php\" method=\"post\">
                    <input type=\"submit\" name=\"mainmen\" value=\"Return to main menu\" /><br>
                    </form>";
                    */

                    $rating = $row['rating'];
                    $total = $row['total'];
                }

                 /* Freeing memory */




            }
            $result->close();

            $query2 = sprintf("update movies set rating=%f,total=%d where name=\"%s\"", (($rating + $_POST['rating'] * $total) / ($total + 1)), $total + 1, $movieName);

            $result2 = $db_connection->query($query2);

            if ($result2) {
              $body .= "<h2>Thank you for your submission!</h2><br>";
              $body .= '<a href="select.php">
                <input type="button" value="Back">
              </a><br><br>';
            }else{
                die("Retrieval failed: ". $db_connection->error);
            }

            $db_connection->close();


        }
        else{
          die("Retrieval failed: ". $db_connection->error);

         }




    }
    echo generatePage($body);


?>
