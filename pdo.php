<?php
try
{
	$conn = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
    echo "Conectado";
	echo "<br>---------------<br>";
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
?>