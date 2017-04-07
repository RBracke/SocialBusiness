<?php

session_start();

include("functions.php");

user_login();

fill_session($_SESSION["user_id"]);

echo $_SESSION["logged_in"];

/*
echo $_SESSION["colleague"]["logged_in"];
echo "<br>";
echo $_SESSION["colleague"]["name"];
echo "<br>";
echo $_SESSION["colleague"]["nin"];
echo "<br>";
echo $_SESSION["colleague"]["address"];
echo "<br>";
echo $_SESSION["colleague"]["gender"];
echo "<br>";
echo $_SESSION["colleague"]["email"];
echo "<br>";
echo $_SESSION["colleague"]["profile_picture"];
echo "<br>";
echo $_SESSION["colleague"]["in_building"];
echo "<br>";
echo $_SESSION["colleague"]["date_of_birth"];
echo "<br>";
echo $_SESSION["colleague"]["martial_status"];
echo "<br>";
echo $_SESSION["colleague"]["phone_number"];
echo "<br>";
echo $_SESSION["colleague"]["function"];
echo "<br>";
echo $_SESSION["colleague"]["rights"]["check_in_out"];
echo "<br>";
echo $_SESSION["colleague"]["rights"]["info"];
echo "<br>";
echo $_SESSION["colleague"]["rights"]["messages"];
echo "<br>";*/
?>