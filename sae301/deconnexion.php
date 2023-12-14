<?php
session_start();
session_destroy(); // supprime la session en cours
header("Location: index.php");
?>