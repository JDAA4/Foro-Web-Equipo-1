<?php
session_start();
session_unset();
session_destroy();
header('../src/views/login.php');
?>