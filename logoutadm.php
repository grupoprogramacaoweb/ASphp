<?php
session_start();
unset ($_SESSION['verificadoradm']);
unset ($_SESSION['nomedoadm']);
unset ($_SESSION['idadm']);
//session_destroy();
header('Location: index.php');
?>
