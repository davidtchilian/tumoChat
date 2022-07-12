<?php
session_start();
session_destroy();
header("Location: ../views/logIn.php?id=2");
?>