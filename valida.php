﻿<?php  
/* Alex kubiaki dos Santos  AP2 --> 18/10/2020 --> Pandemia Mode ON*/

if (($_POST['usuario']=='admin') && $_POST['senha']=='admin') {
	echo "<script language='javascript' type='text/javascript'>window.location.href='admin.php'</script>";
}

session_start();
session_destroy();
$login = $_POST['usuario'];
$senha = $_POST['senha'];

try {
 		//conexao
			//$conexao =new mysqli("localhost","root","","banco");	 ///*mysql usa essa conexão*///
			  $conexao = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root"); 
	    //conexao
  
	} 
	catch (PDOException $e)
	{
		echo 'Falha na conexão: ' . $conexao->getMessage();
	}
		
	function encontrou($log,$pass)   // usei para testar se o usuario ja existe
		{   $conexao = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root"); 
			$query = $conexao->prepare("select count(*)  as num from tb_usuarios where login = '$log' and senha ='$pass' ");
			$query->execute();
			$retorno =$query->fetch(PDO::FETCH_ASSOC);
 			
			if ($retorno['num'] ==1)
				{
					return 1;
				}
			else		 
			{
              return 0;
			}
		}	
	
	$linhas=encontrou($login,$senha);	
	$result = $conexao->query("select * from tb_usuarios where login='$login' and senha='$senha'");
	
	if($linhas==1)
		{ 
			session_start();
			$data = array();
			while ($registros = $result->fetch(PDO::FETCH_ASSOC))

				{
					
					$_SESSION['nomedouser'] = $registros["login"];
					echo "<p><b><font size='10'>Bem vindo : ".$registros["login"]."</font></b></p>";
					echo "<p><b><font size='10'>Seu ID interno é: ".$registros["idusuario"]."</font></b></p>";
					echo "<p><b><font size='10'>Sua data de cadastro é: ".$registros["dacadastro"]."</font></b></p>";
					echo "<p><b><font size='10'>Usuário logado : ".$_SESSION['nomedouser']."</font></b></p>";
					echo "<a href=\"index.php\">Retornar a página de login</a>";
					echo "<p>";
					echo "<a href=\"logout.php\">Logout</a>";
					echo "aqui";
				}
		}       
		else
		{
		 echo"<script language='javascript' type='text/javascript'>alert('Nome de usuário ou senha Inválida');
			window.location.href='index.php';</script>";
		}
echo "<p>";

	
?>
