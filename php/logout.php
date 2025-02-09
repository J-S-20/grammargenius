<?php
session_start();
session_destroy();
header("Location: ../topics/login.html");
?>
