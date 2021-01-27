<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['adminid']);
session_destroy();
exit(header("Location:index.php"));
?>
