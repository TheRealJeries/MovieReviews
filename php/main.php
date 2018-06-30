<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- For responsive page -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <title>Review Movies!</title>
    </head>

    <body>
        <div class="center">
            <h1 class="title">Welcome to Movie Reviews!</h1>
            <img class="img_center" src="https://png2.kisspng.com/sh/c1fd9766032ccbdf58a68925350e855b/L0KzQYm3UsE3N6Nwj5H0aYP2gLBuTgBpd6V0fARqcHjsc37tifxuNaNqfd42Y3zsgH7okwQudZD7gdc2ZnnvfX68gcg3P2g6TqZqOXPlQ3A7V8kxO2I8SaMAMUi6RoKBUcQ0OGY7RuJ3Zx==/kisspng-photographic-film-reel-clip-art-movie-film-5a8677564a9cb3.4790317115187618143056.png" alt="reel logo" width="150px" height="150px">
            <h3>Sign in</h3>
            <form action="select.php" method="post" class="form-inline">
                <label for="email" style="padding-left:30px;">Email:</label>
                <input type="email" name="email" method="post" placeholder="Email">
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" method="post" placeholder="Password">
                <br><br>
                <input type="submit" name="submit" method="post" value="Log in">
            </form>

            <br><hr>
            <h4>Don't have an account?<em> Create one for free</em></h4>
            <br>
            
            <form action="main.php" method="post" class="form-inline">
                <input type="email" name="new_email" method="post" placeholder="Email">
                <br><br>
                <input type="password" name="new_password" method="post" placeholder="Password">
                <br><br>
                <input type="password" name="new_password_verify" method="post" placeholder="Verify password">
                <br><br>
                <input type="submit" name="new_submit" method="post" value="Create account">
            </form>
        </div>
    </body>
</html>
