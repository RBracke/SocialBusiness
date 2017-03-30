<?php

session_start();

echo $_SESSION["logged_in"];
echo "<br>";
echo $_SESSION["name"];
echo "<br>";
echo $_SESSION["nin"];
echo "<br>";
echo $_SESSION["address"];
echo "<br>";
echo $_SESSION["gender"];
echo "<br>";
echo $_SESSION["email"];
echo "<br>";
echo $_SESSION["profile_picture"];
echo "<br>";
echo $_SESSION["in_building"];
echo "<br>";
echo $_SESSION["date_of_birth"];
echo "<br>";
echo $_SESSION["martial_status"];
echo "<br>";
echo $_SESSION["phone_number"];
echo "<br>";
echo $_SESSION["function"];
echo "<br>";
echo $_SESSION["rights"]["check_in_out"];
echo "<br>";
echo $_SESSION["rights"]["info"];
echo "<br>";
echo $_SESSION["rights"]["messages"];
echo "<br>";
?>