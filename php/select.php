<?php
  require_once("supportForSelect.php");

  $top = <<<EOTOP
    <div class="center">
        <h1 class="title">Lets See What We Have!</h1>
        <img class="img_center" src="../images/reel.png" alt="reel logo" width="150px" height="150px">
        <form action="select.php" method="post">
        <em><input type="text" name="search_name" id="search_name" placeholder="Please enter the keywords of the movie" size="60%" /></em>
        <input type="submit" name="sub_search" id="sub_search" value="Find" />
        <input type="submit" name="back" id="back" value="Clear" />
        </form>
    </div>

EOTOP;

  $table = <<<EOTABLE

    <hr>
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
    $table .= <<<EOSE
    <div class="center"><h3>Keywords: <em>$search_name</em></h3></div>
EOSE;

    $search_query = 'select name, image, rating from movies where name like '."'%{$search_name}%'";

    $search_result = $connect_movies->query($search_query);

    if ($search_result) {
      $num_rows = $search_result->num_rows;

      if ($num_rows !== 0) {
  			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
  				$search_result->data_seek($row_index);
          $row = $search_result->fetch_array(MYSQLI_ASSOC);
          $imag = base64_encode($row["image"]);
          $rate = $row["rating"];
          $name = $row["name"];

          $table .= <<<EOIMAG
          <tr>
            <td class="col-xs-4">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <div class="text-center">
              <img src="data:image/jpeg;base64, {$imag}" width="120" height="160" style="margin: 1em;"/>
              </div>
              </a>
            </form>
            </td>
            <td class="col-xs-6">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <strong><em>$name</em></strong>
            </a>
            </form>
            </td>
            <td class="col-xs-2"><strong>$rate</strong></td>
          </tr>
EOIMAG;

        }
      } else {
        $empty = true;
      }





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
            <td class="col-xs-4">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <div class="text-center">
              <img src="data:image/jpeg;base64, {$imag}" width="120" height="160" style="margin: 1em;"/>
              </div>
              </a>
            </form>
            </td>
            <td class="col-xs-6">
            <form action="display.php" method="post">
              <a href="#" onclick="$(this).closest('form').submit();">
              <input type="hidden" name="movie_to_be_displayed" value="$name" />
              <strong><em>$name</em></strong>
            </a>
            </form>
            </td>
            <td class="col-xs-2, rate"><strong>$rate</strong></td>
          </tr>
EOIMAG;

        }
      }
    }

  }


  $table .= "</tbody></table>";
  if ($empty) {
    $body = $top."<hr><div class=\"center\"><h3>No Movie Found!</h3></div>";
  } else {
    $body = $top.$table;
  }

  $connect_movies->close();
  echo generatePage($body);
?>
