<?php
session_start();
unset($_SESSION);
session_destroy();
echo("../SignUpLogin/loginSignUp.php");

?>