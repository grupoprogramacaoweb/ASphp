<?php
session_start();


	if(isset($_SESSION['nomedouser']))
	{
		echo "Usuário Logado: ".$_SESSION['nomedouser'];
		echo "<p>";
		echo "<a href=\"logout.php\">Logout</a>";
	}
  else
	{
	 echo "Nenhum usuário logado";
	}
?>
