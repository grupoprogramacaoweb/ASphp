<?php
session_start();
unset ($_SESSION['verificador']);
unset ($_SESSION['nomedouser']);
unset ($_SESSION['iduser']);
 //session_destroy();
header('Location: index.php');
?>
