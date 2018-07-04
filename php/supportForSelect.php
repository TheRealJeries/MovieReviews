<?php

function generatePage($body) {
    $page = <<<EOPAGE
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <!-- For responsive page -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/main.css">
            <title>Review Movies!</title>
            <style>
              table {
                margin: 0 auto;
                width: 80%;
              }
              a {
                color: black;
                font: em;
                font-size: 16px;
              }
              .rate {
                font-size: 20px;
                text-align: center;
                color: blue;
              }
            </style>
        </head>

    <body>
        $body
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
EOPAGE;

    return $page;
}
?>
