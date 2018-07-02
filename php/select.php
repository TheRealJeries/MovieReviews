<?php
  require_once("support.php");

  $top = <<<EOTOP
    <div class="center">
        <h1 class="title">Lets See What We Have!</h1>
        <img class="img_center" src="../images/reel.png" alt="reel logo" width="150px" height="150px">
        <form action="select.php" method="post">
        <em><input type="text" name="search_name" id="search_name" placeholder="Please enter the name of the movie" size="60%"/></em>
        <input type="submit" name="sub_search" id="sub_search" value="find" />
        </form>
    </div>

EOTOP;

  $table = <<<EOTABLE
  <form action="display.php" method="post">
    <table class="table, table-striped table-bordered">
      <tbody>

EOTABLE;

  $empty = false;

  $connect_movies = new mysqli("localhost", "user", "user", "moviereviews");
  if ($connect_movies->connect_error) {
    echo "Connect failed.\n";
    die($connect_movies->connect_error);
  }

  if (isset($_POST["sub_search"]) && $_POST["search_name"] !== "") {

    $search_name = $_POST["search_name"];

    $search_query = 'select image, rating from movies where name = '."'{$search_name}'";

    $search_result = $connect_movies->query($search_query);


      $search_row = $search_result->fetch_array(MYSQLI_ASSOC);
      $search_imag = base64_encode($search_row["image"]);
      $search_rate = $search_row["rating"];

      if ($search_imag != "") {
      $table .= <<<EOIMAG
      <tr>
        <td>
          <a href="#" onclick="$(this).closest('form').submit();">
          <input type="hidden" name="movie_to_be_displayed" value="$search_name" />
          <img src="data:image/jpeg;base64, {$search_imag}" />
          </a>
        </td>
        <td>
        <a href="#" onclick="$(this).closest('form').submit();">
        <input type="hidden" name="movie_to_be_displayed" value="$search_name" />
        <strong>$search_name</strong>
        </a>
        </td>
        <td><strong>$search_rate</strong></td>
      </tr>
EOIMAG;

      } else {
        $empty = true;
      }



  } else {
    $query = "select name, image, rating from movies";
    $result = $connect_movies->query($query);

    if ($result) {
      $num_rows = $result->num_rows;

      if ($num_rows !== 0) {
  			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
  				$result->data_seek($row_index);
          $row = $result->fetch_array(MYSQLI_ASSOC);
          $imag = base64_encode($row["image"]);
          $rate = $row["rating"];
          $name = $row["name"];

          $table .= <<<EOIMAG
          <tr>
            <td>
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <img src="data:image/jpeg;base64, {$imag}" />
              </a>
            </td>
            <td>
            <a href="#" onclick="$(this).closest('form').submit();">
            <input type="hidden" name="movie_to_be_displayed" value="$name" />
            <strong>$name</strong>
            </a>
            </td>
            <td><strong>$rate</strong></td>
          </tr>
EOIMAG;

        }
      }
    }

  }


  $table .= "</tbody></table></form>";
  if ($empty) {
    $body = $top."No Movie Found!";
  } else {
    $body = $top.$table;
  }

  $connect_movies->close();
  echo generatePage($body);
?>
