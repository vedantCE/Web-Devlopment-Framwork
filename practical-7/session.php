
<?php
session_start();
$_SESSION["Username"]=$_POST["txtuname"];
echo "<p><b>Session(Username):</b>".$_SESSION["Username"]."</p>";

setcookie("password",$_POST["txtpsd"]);
echo "<p><b>Cookie(password):</b>".$_COOKIE["password"]."</p>";

?>