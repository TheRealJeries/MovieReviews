<?php
	/* Inserts image */
    require_once("support.php");

    //$MovieNAme does not exist yet
    $host = "localhost";
	$user = "user";
	$password = "user";
	$database = "moviereviews";
	$table = "movies";
    //$db = connectToDB($host, $user, $password, $database);
    $db_connection = new mysqli($host, $user, $password, $database);

    if(!isset($_POST["submit"])){
    $body = <<<EOBODY

    <h2>Movie Name</h2><br><br>

    <form action="" method="post">

        Rating: <input type="number" id="rating" name="rating" min="0" max="10" step="0.1"> /10 <br><br>

        Comment:<br>
        <input type ="textarea" name="comment" id="comment" rows="20" cols="50"><br>

        <input type="submit" name="submit" id="back" value="Submit"><br>

    </form>

    <form action="" method="post">

        <input type="submit" name="back" id="back" value="Back"><br>

    </form>


EOBODY;

    echo generatePage($body);

    
    }else{

        $rating;
        $total;

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

            $query2 = sprintf("update movies set rating=%f,total=%d where name=\"%s\"", (($rating += $_POST['rating'])/2), $total, $movieName); 

            $result2 = $db_connection->query($query2);

            if ($result2) {

            }else{
                die("Retrieval failed: ". $db_connection->error);
            }

            $db_connection->close();


        }
        else{
          
            echo "No entry exists in the database for the specified email and password";
 
         } 
        
        /* Freeing memory */
        $result->close();
        
        /* Closing connection */
        $db_connection->close();


    }
    

?>