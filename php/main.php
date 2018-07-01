<?php
    include("support.php");
    
    $bodyTop = <<<CODE
        <div class="center">
            <h1 class="title">Welcome to Movie Reviews!</h1>
            <img class="img_center" src="https://png2.kisspng.com/sh/c1fd9766032ccbdf58a68925350e855b/L0KzQYm3UsE3N6Nwj5H0aYP2gLBuTgBpd6V0fARqcHjsc37tifxuNaNqfd42Y3zsgH7okwQudZD7gdc2ZnnvfX68gcg3P2g6TqZqOXPlQ3A7V8kxO2I8SaMAMUi6RoKBUcQ0OGY7RuJ3Zx==/kisspng-photographic-film-reel-clip-art-movie-film-5a8677564a9cb3.4790317115187618143056.png" alt="reel logo" width="150px" height="150px">
            <h3>Sign in</h3>
            <form action="main.php" method="post" class="form-inline">
                <label for="email" style="padding-left:30px;">Email:</label>
                <input type="email" name="email" method="post" placeholder="Email" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" method="post" placeholder="Password" required>
                <br><br>
                <input type="submit" name="submit" method="post" value="Log in">
            </form>
        </div>
CODE;
    $bodyTopMessage = "<br>";
    $bodyBot = <<<CODE
        <div class="center">
            <h4>Don't have an account?<em> Create one for free</em></h4>
            <br>

            <form action="main.php" method="post" class="form-inline">
                <input type="email" name="new_email" method="post" placeholder="Email" required>
                <br><br>
                <input type="password" name="new_password" method="post" placeholder="Password" required>
                <br><br>
                <input type="password" name="new_password_verify" method="post" placeholder="Verify password" required>
                <br><br>
                <input type="submit" name="new_submit" method="post" value="Create account">
            </form>
        </div>
CODE;
    $bodyBotMessage="<br>";
    if (isset($_POST["new_submit"])) {
        if ($_POST["new_password"] == $_POST["new_password_verify"]) {
            $connect = mysqli_connect("localhost", "user", "user", "moviereviews");
            if (mysqli_connect_errno()) {
                echo "Connect failed.\n".mysqli_connect_error();
                exit();
            }
            $sqlquery = sprintf("insert into users (email, password) values ('%s', '%s')", 
                        $_POST["new_email"], password_hash($_POST["new_password"], PASSWORD_DEFAULT));
            $result = mysqli_query($connect, $sqlquery);
            mysqli_close($connect);
            $bodyBotMessage = "<h4 class=\"center\">Account successfully created.</h4>";
        } else {
            $bodyBotMessage =  "<h4 style=\"text-align: center; color:red;\"> error: passwords do not match</h4>";
        }
    }
    
    if (isset($_POST["submit"])) {
        $connect = mysqli_connect("localhost", "user", "user", "moviereviews");

        $sqlquery = sprintf("select email,password from users where email=\"".$_POST["email"]."\"");
        $result = mysqli_query($connect, $sqlquery);
        if ($result) {
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (count($data) > 0)
                if (password_verify($_POST["password"], $data["password"])) {
                    header('Location: select.php');
                } else
                    $bodyTopMessage = "<h4 style=\"text-align: center; color:red;\"> error: incorrect password</h4>";
            else
                $bodyTopMessage = "<h4 style=\"text-align: center; color:red;\"> error: email does not exist</h4>";
        } else {
            echo "shit";
        }
    }


    echo generatePage($bodyTop.$bodyTopMessage."<hr>".$bodyBot.$bodyBotMessage);
?>