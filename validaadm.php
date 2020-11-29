<html>
 <head>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
	<title>Portal do Administrador</title>
	  	 <link rel="stylesheet" href="css.css">
 </head>

<body>

	<fieldset>
		<div style="background-color:#B0E0E6;text-align:center">
			<p><font size="10">Portal do Administrador</font></p>
		</div>
		
		<br>
		
		  <?php  
/* Alex kubiaki dos Santos  AP2 --> 18/10/2020 --> Pandemia Mode ON*/



 

session_start();
 

if(isset($_POST['usuarioadm'])) $loginadm = $_POST['usuarioadm'];
if(isset($_POST['senhaadm']))   $senhaadm = $_POST['senhaadm'];


if(isset($_SESSION['verificadoradm']))	if ($_SESSION['verificadoradm']==1)
		{
		
		echo " <div align='center'><p><b><font size='10'>Bem vindo Admnistrador*:".$_SESSION['nomedoadm']."</font></b></p> </div>";
		}

if(empty($_SESSION['verificadoradm']))
{
try {
 		//conexao
			//$conexao =new mysqli("localhost","root","","banco");	 ///*mysql usa essa conexão*///
			  $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
	    //conexao
  
	} 
	catch (PDOException $e)
	{
		echo 'Falha na conexão: ' . $conexao->getMessage();
	}
		
	function encontrou($log,$pass)   // usei para testar se o usuario ja existe
		{   $conexao = new PDO('mysql:host=localhost;dbname=dbphp7', "root", "");
			$query = $conexao->prepare("select count(*)  as num from tb_usuarios_adm where loginusuario = '$log' and senhausuario ='$pass' ");
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
		
		
		
	 	$linhas=encontrou($loginadm,$senhaadm);	
	
	    $result = $conexao->query("select * from tb_usuarios_adm where loginusuario='$loginadm' and senhausuario='$senhaadm'");
	
	if($linhas==1)
		{ 

			$data = array();
			while ($registros = $result->fetch(PDO::FETCH_ASSOC))

				{
					
					$_SESSION['nomedoadm'] = $registros["nomeusuario"];
					$_SESSION['idadm']     = $registros["idusuario"];
					$_SESSION['verificadoradm']=1;
					echo " <div align='center'><p><b><font size='10'>Bem vindo Administrador: ".$_SESSION['nomedoadm']."</font></b></p> </div>";
				}
		}       
		else
		{
		 echo"<script language='javascript' type='text/javascript'>alert('Nome do Administrador ou senha Inválida');
			window.location.href='indexadmin.php';</script>";
		}
echo "<p>";
}
	
?>

		<table align="center">
			<tr>


		</table>
		 <table align="center">
			<tr>
				<td><input type="button" value="Gerenciar cursos" id="Escolhe Cursos" onClick=location.href="gerenciacurso.php" class="btlogin">
				<td><input type="button" value="Logout" id="Logout" onClick=location.href="logoutadm.php" class="btlogin">
			</tr>
			<p>
		</table>
		<br>
	</fieldset>
 </form>
 
	<div style="background-color:#B0E0E6;text-align:center">
		<p><font size="3">Todos direitos reservados a Alex Kubiaki - Mauricio Godoy - Pedro Henrique Schmidt</font></p>
	</div>
	</body>
</html>